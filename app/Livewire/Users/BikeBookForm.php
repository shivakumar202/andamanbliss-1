<?php

namespace App\Livewire\Users;

use App\Models\Addon;
use App\Models\Booking;
use App\Models\Pricing;
use Carbon\Carbon;
use Livewire\Component;

class BikeBookForm extends Component
{
    public $bike,$totalCost,$bikes=1;
    public $addon_quantities = [];
    public $addons, $cakeAddonId;
    public $isSubmitted = false;
    public $location;
    public $price;
    public $name, $email, $dateOfBooking, $mobile, $BikeDetails;
    public $website = null;
    public $isProcessing = false;

    public function __construct()
    {
        $this->dateOfBooking = Carbon::now()->format('d-m-Y');
    }

    public function mount($bike)
    {
        if (!empty($bike)) {
            $this->location = request()->get('location');
    
            if (!empty($bike->pricing)) {
                $price = $bike->pricing->firstWhere('location', $this->location);
    
                if ($price) {
                    $this->totalCost = $price->price;
                    $this->price = $price->price;
                } else {
                    $this->totalCost = $bike->adult_price;
                    $this->price = $bike->adult_price;
                }
            } else {
                $this->totalCost = 0;
            }
        }
    }
    
    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'mobile' => 'required|digits_between:10,11',
        'website' => 'nullable|prohibited',
    ];

    protected $messages = [
        'name.required' => 'Please Enter Name',
        'email.required' => 'Please Enter Email ',
        'email.email' => 'Please Enter Proper Email',
        'mobile.required' => 'Please Enter Mobile Number',
        'mobile.digits_between' => 'Enter Proper Mobile Number'
    ];
    public function increment($type)
    {
        if($type === 'bike')
        {
            $this->bikes++;
        }
        $this->calculate();
    }
    public function decrement($type) 
    {
        if($type === 'bike' && $this->bikes > 1)
        {
            $this->bikes--;
        }
        $this->calculate();
    }

    public function incrementCakeCount($addonId) 
    {
        if(!isset($this->addon_quantities[$addonId])) {
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
    public function toggleAddon($addonId)
    {
        if (isset($this->addon_quantities[$addonId])) {
            unset($this->addon_quantities[$addonId]);
        } else {
            $this->addon_quantities[$addonId] = 1;
        }

        $this->calculate();
    }

    protected function calculate()
    {
       $bikeCost = $this->price * $this->bikes;
       $addonsCost = 0;
       foreach($this->addon_quantities as $addonId => $quantity) {
           $addon = Addon::find($addonId);
           if($addon) {
               if($addonId == $this->cakeAddonId && $quantity == 0) {
                   unset($this->addon_quantities[$addonId]);
               }
               $addonsCost += $addon->price * $quantity;

           }
       }
       $this->totalCost = $bikeCost + $addonsCost;

    }

    public function submit()
    {
        $this->isSubmitted = true;
        $addonData = $this->getAddonNamesWithQuantities();
        $data = [
            'bikes' => $this->bikes,            
            'addon' => $addonData,
            'totalcost' => $this->totalCost,           
        ];
        $this->BikeDetails = $data;
        $this->dispatch('getUserDetail');
    }

    public function done()
{
    if ($this->website != null) {
        $this->dispatch('error', __('Booking Failed: Invalid Submission'));
        return;
    }
    $validatedData = $this->validate();
    if ($this->isProcessing) {
        return;
    }
    $this->isProcessing = true;

    if($this->website != null) {
        $this->dispatch('error', __('Booking Failed Try Again'));
        $this->resetExcept(['activity', 'dateOfBooking']);
        return;
    }
    $data = [
        'name' => $this->name,
        'mobile' => $this->mobile,
        'email' => $this->email,
    ];

    try {
        if ($this->isSubmitted) {
            $mergedData = array_merge($this->BikeDetails, $this->bike->toArray(), $data);

            $addonDetailsArray = [];
            if (!empty($this->BikeDetails['addon']) && is_array($this->BikeDetails['addon'])) {
                $addonDetailsArray = array_map(function ($addon) {
                    return [
                        'id' => $addon['id'],
                        'name' => $addon['name'],
                        'quantity' => $addon['quantity'],
                        'price' => $addon['price'],
                    ];
                }, $this->BikeDetails['addon']);
            }

            $mergedData['addon'] = $addonDetailsArray;
            $latestBooking = Booking::max('booking_id') ?? 0;
            $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);
            $booking = new Booking();
            $booking->fill([
                'booking_id' => $formattedBookingId,
                'table_id' => $mergedData['id'],
                'table_type' => 'services',
                'type' => 'bike',
                'room_id' => null,
                'food_choice' => null,
                'user_id' => auth()->user()->id ?? null,
                'name' => $mergedData['name'],
                'mobile' => $mergedData['mobile'],
                'email' => $mergedData['email'],
                'rate' => $this->price ?? 0.00,
                'address' => null,
                'location' => $this->location,
                'quantity' => $this->bikes ?? 1,
                'price' => ($this->price ?? 0.00) * ($this->bikes ?? 1),
                'adult' => $this->bikes,
                'child' => 0,
                'start_at' => \Carbon\Carbon::parse($this->dateOfBooking)->format('Y-m-d'),
                'status' => 'active',
            ]);
            $booking->save();

            if (!empty($addonDetailsArray)) {
                foreach ($addonDetailsArray as $addon) {
                    $addonBooking = new Booking();
                    $addonBooking->fill([
                        'booking_id' => $formattedBookingId,
                        'table_id' => $addon['id'],
                        'table_type' => 'addons',
                        'type' => 'bike',
                        'room_id' => null,
                        'food_choice' => null,
                        'user_id' => auth()->user()->id ?? null,
                        'name' => $mergedData['name'],
                        'mobile' => $mergedData['mobile'],
                        'email' => $mergedData['email'],
                        'rate' => $addon['price'],
                        'quantity' => $addon['quantity'],
                        'price' => $addon['price'] * $addon['quantity'],
                        'adult' => 0,
                        'child' => 0,
                        'start_at' => \Carbon\Carbon::parse($this->dateOfBooking)->format('Y-m-d'),
                        'status' => 'active',
                    ]);
                    $addonBooking->save();
                }
            }


            $mailData['subject'] =  'Bike Enquiry Form';
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
            if ($this->bike['name']) {
                $mailData['body'] .= "Bike Type: {$this->bike['name']}<br/>";
            }
        
            if ($this->dateOfBooking) {
                $mailData['body'] .= "Date of Booking: {$this->dateOfBooking}<br/>";
            }
            if ($this->bikes) {
                $mailData['body'] .= "Bikes : {$this->bikes}";
            }
            if (!empty($this->BikeDetails['addon']) && is_array($this->BikeDetails['addon'])) {
                $mailData['body'] .= "<br/>Addons:<br/>";
                foreach ($this->BikeDetails['addon'] as $addon) {
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
                ->to($mailData['email'], $mailData['name'])
                ->to('amitmandal@andamanbliss.com')
                ->cc(['shivakumar@andamanbliss.com']);
            });    



            $this->dispatch('success', __('Booking enquiry form submitted successfully!'));
            $this->resetExcept(['bike', 'dateOfBooking','price']);
            $this->mount($this->bike);
        }
    } catch (\Exception $e) {
        $this->dispatch('error', __('Booking Failed Try Again'));
        report($e);
        return back()->withErrors(['message' => 'An error occurred while processing the booking.']);
    } finally {
        $this->isProcessing = false;
    }
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

    public function render()
    {
        dd('e');
        if(!empty($this->bike)) {
            $this->addons = Addon::with(['addonPhotos'])->get();
            if($this->bike && $this->bike->addons) {
                $addonIds = explode(',',$this->bike->addons);
                $this->bike->addon_names = $this->addons->whereIn('id',$addonIds);
            }
            $this->cakeAddonId = $this->addons->firstWhere('name','Cake on Arrival')?->id;
        }

        if (auth()->check()) {
            $this->name = auth()->user()->name ?? null;
            $this->mobile = auth()->user()->mobile ?? null;
            $this->email = auth()->user()->email ?? null;
           }
        return view('livewire.users.bike-book-form');
    }
}
