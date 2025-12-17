<?php

namespace App\Livewire\Users\Tours;

use Livewire\Component;
use App\Models\Addon;
use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class TourBookForm extends Component
{
    public $totalCost, $tour, $guest = 1, $child = 0;
    public $addon_quantities = [];
    public $addons, $cakeAddonId;
    public $arrival;
    public $tourDetails;
    public $name, $email, $dateOfBooking, $mobile;
    public $isSubmitted = false;
    public $website;

    public function __construct()
    {
        $this->dateOfBooking = Carbon::now()->format('d-m-Y');
    }
    protected $rules = [
        'arrival' => 'nullable|date',
        'name' => 'required|string',
        'email' => 'required|email',
        'mobile' => 'required|digits_between:10,11',
        'website' => 'nullable|prohibited',
    ];

    protected $messages = [
        'arrival.date' => 'Seleclect Arrival Date',
        'name.required' => 'Please Enter Name',
        'email.required' => 'Please Enter Email ',
        'email.email' => 'Please Enter Proper Email',
        'mobile.required' => 'Please Enter Mobile Number',
        'mobile.digits_between' => 'Enter Proper Mobile Number'
    ];

    public function mount($tour)
    {
        if (!empty($tour)) {
            $this->tour = $tour;
            $this->totalCost = $tour->adult_price;
        }

    
    }


    public function calculate()
    {
        $adultCost = $this->guest * $this->tour->adult_price;
        $childCost = $this->child * $this->tour->adult_price;

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

    public function toggleAddon($addonId)
    {
        if (isset($this->addon_quantities[$addonId])) {
            unset($this->addon_quantities[$addonId]);
        } else {
            $this->addon_quantities[$addonId] = 1;
        }

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
    public function incrementCakeCount($addonId)
    {
        if (!isset($this->addon_quantities[$addonId])) {
            $this->addon_quantities[$addonId] = 0;
        }

        $this->addon_quantities[$addonId]++;
        $this->calculate();
    }

    public function decrementCakeCount($addonId)
    {
        if (isset($this->addon_quantities[$addonId]) && $this->addon_quantities[$addonId] > 1) {
            $this->addon_quantities[$addonId]--;
        } else {
            unset($this->addon_quantities[$addonId]);
        }

        $this->calculate();
    }

    public function submit()
    {
        $this->isSubmitted = true;
        $addonData = $this->getAddonNamesWithQuantities();
        $data = [
            'guest' => $this->guest,
            'child' => $this->child,
            'adult_price' => $this->tour->adult_price,
            'child_price' => $this->tour->adult_price,
            'arrival' => $this->arrival ? $this->arrival : 'not provided',
            'addons' => $addonData,
            'totalcost' => $this->totalCost,
        ];
        $this->tourDetails = $data;
        $this->dispatch('getUserDetail');
    }
   

    public function done()
    {
        if ($this->website != null) {
            $this->dispatch('error', __('Booking Failed: Invalid Submission'));
            return;
        }
        
        $validatedData = $this->validate();
        $data = [
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
        ];
        try {
            if ($this->isSubmitted) {
                $mergedData = array_merge($this->tourDetails, $this->tour->toArray(), $data);

                if (!empty($this->tourDetails['addons']) && is_array($this->tourDetails['addons'])) {
                    $addonDetailsArray = [];
                    foreach ($this->tourDetails['addons'] as $addon) {
                        $addonDetailsArray[] = [
                            'id' => $addon['id'],
                            'name' => $addon['name'],
                            'quantity' => $addon['quantity'],
                            'price' => $addon['price'],
                        ];
                    }
                    $mergedData['addons'] = $addonDetailsArray;
                }
            

                $latestBooking = Booking::max('booking_id') ?? 0;
                $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);

                $service = Service::find($mergedData['id']);

                $booking = new Booking;
                $booking->booking_id = $formattedBookingId;
                $booking->table_id = $mergedData['id'];
                $booking->table_type = 'services';
                $booking->type = 'tour';
                $booking->room_id = null;
                $booking->food_choice = null;
                $booking->user_id = auth()->user()->id ?? null;
                $booking->name = $mergedData['name'];
                $booking->surname = null;
                $booking->mobile = $mergedData['mobile'];
                $booking->email = $mergedData['email'];
                $booking->address = null;
                $booking->rate = $rate = $service?->adult_price ?? 0.00;
                $booking->quantity = $quantity = $mergedData['guest'] + $mergedData['child']  ?? 1;
                $booking->price = $rate * $quantity;
                $booking->adult = $mergedData['guest'] ?? 1;
                $booking->child = $mergedData['child'] ?? 0;
                $booking->start_at = date('Y-m-d', strtotime($mergedData['arrival']));
                $booking->end_at = null;
                $booking->location = null;
                $booking->destination = null;
                $booking->note = null;
                $booking->status = 'active';
                $booking->save();

                if (!empty($mergedData['addons'])) {
                    foreach ($mergedData['addons'] as $addon) {
                        $booking = new Booking;
                        $booking->booking_id = $formattedBookingId;
                        $booking->table_id = $addon['id'];
                        $booking->table_type = 'addons';
                        $booking->type = 'tour';
                        $booking->room_id = null;
                        $booking->food_choice = null;
                        $booking->user_id = auth()->user()->id ?? null;
                        $booking->name = $mergedData['name'];
                        $booking->surname = null;
                        $booking->mobile = $mergedData['mobile'];
                        $booking->email = $mergedData['email'];
                        $booking->address = null;
                        $booking->rate = $addon['price'] ?? 0.00;
                        $booking->quantity = $addon['quantity'] ?? 1;
                        $booking->price = $addon['price'] * $addon['quantity'];
                        $booking->adult = 0;
                        $booking->child = 0;
                        $booking->start_at = date('Y-m-d', strtotime($mergedData['arrival']));
                        $booking->end_at = null;
                        $booking->location = null;
                        $booking->destination = null;
                        $booking->note = null;
                        $booking->status = 'active';
                        $booking->save();
                    }
                }



                $mailData['subject'] =  'Tour Enquiry Form';
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
                if ($this->tour['name']) {
                    $mailData['body'] .= "Package Type: {$this->tour['name']}<br/>";
                }
                if ($this->tour->category['name']) {
                    $mailData['body'] .= "Package Category: {$this->tour->category['name']}<br/>";
                }
              
           
            
                if ($this->arrival) {
                    $mailData['body'] .= "Travel Start Date: {$this->arrival}<br/>";
                }
                if ($this->guest) {
                    $mailData['body'] .= "Adult: {$this->guest}<br/>
                                        Child: {$this->child}<br/>";
                }
                if (!empty($this->tourDetails['addons']) && is_array($this->tourDetails['addons'])) {
                    $mailData['body'] .= "<br/>Addons:<br/>";
                    foreach ($this->tourDetails['addons'] as $addon) {
                        $mailData['body'] .= "- Addon Name: {$addon['name']}<br/>";
                        $mailData['body'] .= "&nbsp;&nbsp;Quantity: {$addon['quantity']}<br/>";
                        $mailData['body'] .= "&nbsp;&nbsp;Price: {$addon['price']}<br/>";
                    }
                }
             
                // $mailData['url'] = url('login');
                // $mailData['button'] = 'Login';
                // $mailData['subbody'] = "You can also use your registered email & mobile as username.";
                $mailData['info'] = 'Note: don\'t share your login credentials & keep it confedential.';
    
                \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
                    $message->subject($mailData['subject'])
                    ->to('amitmandal@andamanbliss.com')
                    ->cc(['shivakumar@andamanbliss.com']);
                        
                });    
    
                $this->dispatch('success', __('Booking enquiry form submitted successfully!'));
                $this->resetExcept(['tour', 'dateOfBooking']);
                $this->mount($this->tour);
            } else {
                $this->dispatch('error', __('Booking Failed Try Again'));
            }
        } catch (\Exception $e) {
            $this->dispatch('error', __('Booking Failed Try Again'));
        }
    }




    public function render()
    {
        if (!empty($this->tour)) {

            $this->addons = Addon::where('type', 'tour')->with(['addonPhotos'])->get();

            if ($this->tour && $this->tour->addons) {
                $addonIds = explode(',', $this->tour->addons);
                $this->tour->addon_names = $this->addons->whereIn('id', $addonIds);
            }

            $this->cakeAddonId = $this->addons->firstWhere('name', 'Cake on Arrival')?->id;
        }
        if (auth()->check()) {
            $this->name = auth()->user()->name ?? null;
            $this->mobile = auth()->user()->mobile ?? null;
            $this->email = auth()->user()->email ?? null;
           }
           
        return view('livewire.users.tours.tour-book-form');
    }

    protected function getAddonNamesWithQuantities()
    {
        $addonData = [];

        foreach ($this->addon_quantities as $id => $quantity) {
            $addon = $this->addons->firstWhere('id', $id);
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
