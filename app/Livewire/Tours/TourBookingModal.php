<?php

namespace App\Livewire\Tours;

use App\Models\Addon;
use App\Models\Booking;
use App\Models\Service;
use Livewire\Component;

class TourBookingModal extends Component
{
    public $tour;
    public $tourId;
    public $tourName;
    public $tourPrice;
    public $tourDate;
    public $tourTime;
    public $tourLocation;
    public $addon_quantities = [];
    public $addons;
    public $tourImage;
    public $tourCapacity;
    public $totalCost, $guest = 1, $child = 0;
    public $showModal = false;
    public $name;
    public $email;
    public $mobile;
    public $url;
    public $arrival_date;
    public $isSubmitted = false;
    public $website;

    protected $rules = [
        'arrival_date' => 'required|date',
        'name' => 'required|string',
        'email' => 'required|email',
        'mobile' => 'required|digits_between:10,11',
        'website' => 'nullable|prohibited',
        'url' => 'required|url',
    ];

    public function mount($tour)
    {
        $this->tour = $tour;
        $this->tourId = $tour->id;
        $this->tourName = $tour->name;
        $this->tourPrice = $tour->adult_price;
        $this->tourLocation = $tour->address;
        $this->addons = $tour->addon_names;
        $this->url = url()->current();
        $this->calculate();
    }

    public function increment($type)
    {
        if ($type === 'guest') {
            $this->guest++;
        } elseif ($type === 'child') {
            $this->child++;
        }
        $this->calculate();
    }

    public function decrement($type)
    {
        if ($type === 'guest' && $this->guest > 1) {
            $this->guest--;
        } elseif ($type === 'child' && $this->child > 0) {
            $this->child--;
        }
        $this->calculate();
    }

    public function checkFormThenShowModal()
    {
        $this->resetErrorBag();
        $this->validate([
            'guest' => 'required|integer|min:1',
            'child' => 'required|integer|min:0',
            'arrival_date' => 'required|date',
        ]);
        $this->dispatch('showBookingModal');
    }

    public function calculate()
    {
        $adultCost = $this->guest * $this->tour->adult_price;
        $childCost = $this->child * $this->tour->adult_price;

        $addonsCost = 0;
        foreach ($this->addon_quantities as $addonId => $quantity) {
            $addon = Addon::find($addonId);
            if ($addon) {
                $addonsCost += $addon->price * $quantity;
            }
        }

        $this->totalCost = $adultCost + $childCost + $addonsCost;
    }

    public function toggleAddon($addonId)
    {
        if (isset($this->addon_quantities[$addonId])) {
            unset($this->addon_quantities[$addonId]);
        } else {
            $this->addon_quantities[$addonId] = 1;
        }
        $this->calculate();
    }

    public function done()
    {
        if (!property_exists($this, 'website') || !empty($this->website)) {
            session()->flash('error', 'Spam detected. Submission blocked.');
            return;
        }

        $this->validate();
        $this->isSubmitted = true;

        $addonDetailsArray = $this->getAddonNamesWithQuantities();

        try {
            $latestBooking = Booking::max('booking_id') ?? 0;
            $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);

            $service = Service::find($this->tourId);

            $rate = $service?->adult_price ?? 0.00;
            $quantity = ($this->guest ?? 1) + ($this->child ?? 0);

            $booking = new Booking;
            $booking->booking_id = $formattedBookingId;
            $booking->table_id = $this->tourId;
            $booking->table_type = 'services';
            $booking->type = 'tour';
            $booking->user_id = auth()->user()->id ?? null;
            $booking->name = $this->name;
            $booking->mobile = $this->mobile;
            $booking->email = $this->email;
            $booking->rate = $rate;
            $booking->quantity = $quantity;
            $booking->price = $rate * $quantity;
            $booking->adult = $this->guest ?? 1;
            $booking->child = $this->child ?? 0;
            $booking->start_at = date('Y-m-d', strtotime($this->arrival_date));
            $booking->status = 'active';
            $booking->save();

            foreach ($addonDetailsArray as $addon) {
                $addonBooking = new Booking;
                $addonBooking->booking_id = $formattedBookingId;
                $addonBooking->table_id = $addon['id'];
                $addonBooking->table_type = 'addons';
                $addonBooking->type = 'tour';
                $addonBooking->user_id = auth()->user()->id ?? null;
                $addonBooking->name = $this->name;
                $addonBooking->mobile = $this->mobile;
                $addonBooking->email = $this->email;
                $addonBooking->rate = $addon['price'] ?? 0.00;
                $addonBooking->quantity = $addon['quantity'] ?? 1;
                $addonBooking->price = $addon['price'] * $addon['quantity'];
                $addonBooking->adult = 0;
                $addonBooking->child = 0;
                $addonBooking->start_at = date('Y-m-d', strtotime($this->arrival_date));
                $addonBooking->status = 'active';
                $addonBooking->save();
            }
        } catch (\Exception $e) {
            $this->dispatch('error', __('Failed to submit booking: ') . $e->getMessage());
            return;
        }

        $mailData = [
            'subject' => 'Tour Enquiry Form',
            'email' => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
            'name' => env('MAIL_FROM_NAME', 'AndamanBliss'),
            'body' => "",
            'info' => 'Note: don\'t share your login credentials & keep it confidential.'
        ];

        $mailData['body'] .= "Name: {$this->name}<br/>";
        $mailData['body'] .= "Mobile: {$this->mobile}<br/>";
        $mailData['body'] .= "Email: {$this->email}<br/>";
        $mailData['body'] .= "Package Type: {$this->tour->name}<br/>";
        $mailData['body'] .= "Package Category: {$this->tour->category->name}<br/>";
        $mailData['body'] .= "Arrival Date: {$this->arrival_date}<br/>";
        $mailData['body'] .= "Adult: {$this->guest}<br/>Child: {$this->child}<br/>";

        if (!empty($addonDetailsArray)) {
            $mailData['body'] .= "<br/>Addons:<br/>";
            foreach ($addonDetailsArray as $addon) {
                $mailData['body'] .= "- Addon Name: {$addon['name']}<br/>";
                $mailData['body'] .= "&nbsp;&nbsp;Quantity: {$addon['quantity']}<br/>";
                $mailData['body'] .= "&nbsp;&nbsp;Price: {$addon['price']}<br/>";
            }
        }

        $mailData['body'] .= "LEAD URL: {$this->url}<br/>";

        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])
                ->to('info@andamanbliss.com')
                ->cc('amitmandal@andamanbliss.com');
        });

        $this->dispatch('success', __('Booking enquiry form submitted successfully!'));
        $this->resetExcept('tour', 'tourId', 'tourName', 'tourPrice', 'tourLocation');
    }

    public function render()
    {
        if (auth()->check()) {
            $this->name = auth()->user()->name ?? null;
            $this->mobile = auth()->user()->mobile ?? null;
            $this->email = auth()->user()->email ?? null;
        }

        return view('livewire.tours.tour-booking-modal');
    }

    protected function getAddonNamesWithQuantities()
    {
        $addonData = [];

        foreach ($this->addon_quantities as $id => $quantity) {
            $addon = Addon::find($id);
            if ($addon) {
                $addonData[] = [
                    'id' => $id,
                    'name' => $addon->name,
                    'quantity' => $quantity,
                    'price' => $addon->price,
                ];
            }
        }

        return $addonData;
    }

    public function hydrate()
    {
        if ($this->isSubmitted) {
            $this->resetErrorBag();
            $this->resetValidation();
        }
    }
}
