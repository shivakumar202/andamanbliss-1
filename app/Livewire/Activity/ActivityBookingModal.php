<?php

namespace App\Livewire\Activity;

use App\Models\ActivitySlots;
use App\Models\Addon;
use App\Models\Booking;
use Livewire\Component;

class ActivityBookingModal extends Component
{
    public $activityId;
    public $activityName;
    public $activityDate;
    public $activityTime;
    public $activityLocation;
    public $activityPrice;
    public $addons, $cakeAddonId;
    public $totalCost, $guest = 1, $child = 0;
    public $showModal = false;
    public $name;
    public $email;
    public $mobile;
    public $arrival_date;
    public $isSubmitted = false;
    public $website = null;
    public $activity;
    public $url;
    public $discountPercentage;
    public $addon_quantities = [];
    public $timeSlots = [];

    protected $rules = [
        'arrival_date' => 'required|date',
        'name' => 'required|string',
        'email' => 'required|email',
        'mobile' => 'required|digits_between:10,11',
        'website' => 'nullable|prohibited',
        'url' => 'required|url',

    ];

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
        $adultCost = $this->guest * $this->activityPrice;
        $childCost = $this->child * $this->activityPrice;

        $addonsCost = 0;
        foreach ($this->addon_quantities as $addonId => $quantity) {
            $addon = Addon::find($addonId);
            if ($addon) {
                if ($addonId == $this->cakeAddonId && $quantity == 0) {
                    unset($this->addon_quantities[$addonId]);
                }
                $addonsCost += $addon->price * $quantity;
            }
        }

        $this->totalCost = $adultCost + $childCost + $addonsCost;
    }
    public function mount($activity)
    {
        $this->activity = $activity;
        $this->activityId = $activity->id;
        $this->activityName = $activity->name;
        $this->activityDate = $activity->date;
        $this->activityTime = $activity->time;
        $this->activityLocation = $activity->address;
        $slot = ActivitySlots::where('activityid',$activity->id)->first();


        $this->generateTimeSlots($slot);
        $this->url = url()->current();
        $this->calculateDiscount();
        $this->calculate();
    }

protected function generateTimeSlots($slot)
{
    if (!$slot) {
        return;
    }

    $this->timeSlots = [];

    $start = \Carbon\Carbon::parse($slot->slot_start);
    $end = \Carbon\Carbon::parse($slot->slot_end);
    $duration = intval($slot->duration);

    while ($start->copy()->addMinutes($duration)->lte($end)) {
        $slotStart24 = $start->format('H:i');
        $slotEnd24 = $start->copy()->addMinutes($duration)->format('H:i');

        $slotStart12 = $start->format('h:i A');
        $slotEnd12 = $start->copy()->addMinutes($duration)->format('h:i A');

        $this->timeSlots[] = [
            'label' => "$slotStart12 - $slotEnd12", // For display (AM/PM)
            'value' => "$slotStart24 - $slotEnd24", // For storage
        ];

        $start->addMinutes($duration);
    }
}



 public function submitBookingForm()
    {
        $this->resetErrorBag();

        $this->validate([
            'guest' => 'required|integer|min:1',
            'child' => 'required|integer|min:0',
            'arrival_date' => 'required|date',
            'activityTime' => 'nullable|string',
        ]);

        $this->calculate();

        $data = [
            'activity_id' => $this->activity->id,
            'guest' => $this->guest,
            'child' => $this->child,
            'arrival_date' => $this->arrival_date,
            'time_slot' => $this->activityTime,
            'addon_quantities' => $this->addon_quantities,
            'person_cost' => $this->activityPrice,
            'total_cost' => $this->totalCost,
        ];
        session()->put('activity_booking_data', $data);

        return redirect()->route('activity.review');
    }


public function calculateDiscount()
{
    $basePrice = $this->activity->adult_cost;
    $discount = $this->activity->discount;

    $discountAmt = ($basePrice * $discount) / 100;
    $this->activityPrice = (int) ($basePrice - $discountAmt);
}

    public function render()
    {

        if (!empty($this->activity)) {
            $this->addons = Addon::where('type', 'activity')->with(['addonPhotos'])->get();
            if ($this->activity && $this->activity->addons) {
                $addonIds = explode(',', $this->activity->addons);
                $this->activity->addon_names = $this->addons->whereIn('id', $addonIds);
            }
            $this->cakeAddonId = $this->addons->firstWhere('name', 'Cake on Arrival')?->id;
        }

        if (auth()->check()) {
            $this->name = auth()->user()->name ?? null;
            $this->mobile = auth()->user()->mobile ?? null;
            $this->email = auth()->user()->email ?? null;

        }

        return view('livewire.activity.activity-booking-modal');
    }

    public function done()
    {

        $this->validate();

        $this->isSubmitted = true;
        if (!property_exists($this, 'website') || !empty($this->website)) {
            session()->flash('error', 'Spam detected. Submission blocked.');
            return;
        }

        $latestBooking = Booking::max('booking_id') ?? 0;
        $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);

        $booking = new Booking();
        $booking->fill([
            'booking_id' => $formattedBookingId,
            'table_id' => $this->activity['id'],
            'table_type' => 'activity',
            'type' => 'activity',
            'room_id' => null,
            'food_choice' => null,
            'user_id' => auth()->user()->id ?? null,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'rate' => $this->activity['adult_cost'] ?? 0.00,
            'address' => $this->activity['address'],
            'location' => null,
            'quantity' => $this->guest ?? 1,
            'price' => ($this->activity['adult_cost'] ?? 0.00) * ($this->guest ?? 1),
            'adult' => $this->guest,
            'child' => 0,
            'start_at' => \Carbon\Carbon::parse($this->arrival_date)->format('Y-m-d'),
            'slot' => $this->activityTime,
            'status' => 'success',
        ]);
        $booking->save();


        $mailData['subject'] =  'Activity Enquiry Form';
        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
        $mailData['name'] = env('MAIL_FROM_NAME', 'AndamanBliss');
        $mailData['body'] = "";
        if ($this->name) {
            $mailData['body'] .= "Name: {$this->name}<br/>";
        }
        if ($this->mobile) {
            $mailData['body'] .= "Mobile: {$this->mobile}<br/>";
        }
        if ($this->email) {
            $mailData['body'] .= "Email: {$this->email}<br/>";
        }
        if ($this->activity['name']) {
            $mailData['body'] .= "Activity Type: {$this->activity['name']}<br/>";
        }
        if ($this->arrival_date) {
            $mailData['body'] .= "Date of Activity: {$this->arrival_date}<br/>";
        }
        if ($this->guest) {
            $mailData['body'] .= "Guest: Adult : {$this->guest} Child : {$this->child}<br/>";
        }
        $mailData['body'] .= "LEAD URL: {$this->url}<br/>";

        $mailData['info'] = 'Note: don\'t share your login credentials & keep it confedential.';

        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])
                // ->to($mailData['email'], $mailData['name'])
                ->to('info@andamanbliss.com')
                ->cc('amitmandal@andamanbliss.com');
        });

        $this->dispatch('success', __('Booking enquiry form submitted successfully!'));
        $this->resetExcept(['activity', 'activityId', 'activityName', 'activityPrice', 'activityLocation', 'dateOfBooking']);
    }


    public function hydrate()
    {
        if ($this->isSubmitted) {
            $this->resetErrorBag();
            $this->resetValidation();
        }
    }
}
