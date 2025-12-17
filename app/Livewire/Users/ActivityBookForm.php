<?php

namespace App\Livewire\Users;

use App\Models\Addon;
use App\Models\Booking;
use Carbon\Carbon;
use Livewire\Component;
use Psy\CodeCleaner\FunctionContextPass;

class ActivityBookForm extends Component
{
    public $activity, $totalCost, $guest=1;
    public $addon_quantities = [];
    public $addons, $cakeAddonId;
    public $isSubmitted = false;
    public $name, $email, $dateOfBooking, $mobile, $ActivityDetails;
    public $website = null;
    public $isProcessing = false;


    public function __construct()
    {
        $this->dateOfBooking = Carbon::now()->format('d-m-Y');
    }
    public function mount($activity)
    {      
        if(!empty($activity)) {
       $this->activity = $activity;
       $this->totalCost = $activity->adult_price;
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
        if($type === 'guest') {
            $this->guest++;
        }
        $this->calculate();
    }
    public function decrement($type)
    {
        if($type === 'guest' && $this->guest > 1) {
            $this->guest--;
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
    public function submit()
    {
        $this->isSubmitted = true;
        $addonData = $this->getAddonNamesWithQuantities();
        $data = [
            'guest' => $this->guest,            
            'addon' => $addonData,
            'totalcost' => $this->totalCost,           
        ];
        $this->ActivityDetails = $data;
        $this->dispatch('getUserDetail');
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

        $data = [
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,     
        ];

        try {
            if ($this->isSubmitted) {
                $mergedData = array_merge($this->ActivityDetails, $this->activity->toArray(), $data);

                $addonDetailsArray = [];
                if (!empty($this->ActivityDetails['addon']) && is_array($this->ActivityDetails['addon'])) {
                    $addonDetailsArray = array_map(function ($addon) {
                        return [
                            'id' => $addon['id'],
                            'name' => $addon['name'],
                            'quantity' => $addon['quantity'],
                            'price' => $addon['price'],
                        ];
                    }, $this->ActivityDetails['addon']);
                }

                $mergedData['addon'] = $addonDetailsArray;
                $latestBooking = Booking::max('booking_id') ?? 0;
                $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);

                $booking = new Booking();
                $booking->fill([
                    'booking_id' => $formattedBookingId,
                    'table_id' => $mergedData['id'],
                    'table_type' => 'services',
                    'type' => 'activity',
                    'room_id' => null,
                    'food_choice' => null,
                    'user_id' => auth()->user()->id ?? null,
                    'name' => $mergedData['name'],
                    'mobile' => $mergedData['mobile'],
                    'email' => $mergedData['email'],
                    'rate' => $mergedData['adult_price'] ?? 0.00,
                    'address' => $mergedData['address'],
                    'location' => null,
                    'quantity' => $this->guest ?? 1,
                    'price' => ($mergedData['adult_price'] ?? 0.00) * ($this->guest ?? 1),
                    'adult' => $this->guest,
                    'child' => 0,
                    'start_at' => \Carbon\Carbon::parse($this->dateOfBooking)->format('Y-m-d'),
                    'status' => 'pending',
                ]);
                $booking->save();

                if (!empty($addonDetailsArray)) {
                    foreach ($addonDetailsArray as $addon) {
                        $addonBooking = new Booking();
                        $addonBooking->fill([
                            'booking_id' => $formattedBookingId,
                            'table_id' => $addon['id'],
                            'table_type' => 'addons',
                            'type' => 'activity',
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
                            'status' => 'pending',
                        ]);
                        $addonBooking->save();
                    }
                }
              
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
                    $mailData['body'] .= "Package Type: {$this->activity['name']}<br/>";
                }
            
                if ($this->dateOfBooking) {
                    $mailData['body'] .= "Date of Booking: {$this->dateOfBooking}<br/>";
                }
                if ($this->guest) {
                    $mailData['body'] .= "Guest: {$this->guest}";
                }
                if (!empty($this->ActivityDetails['addon']) && is_array($this->ActivityDetails['addon'])) {
                    $mailData['body'] .= "<br/>Addons:<br/>";
                    foreach ($this->ActivityDetails['addon'] as $addon) {
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
                    // ->to($mailData['email'], $mailData['name'])
                    ->to('amitmandal@andamanbliss.com')
                    ->cc(['shivakumar@andamanbliss.com']);
                     
                });    
    
                $this->dispatch('success', __('Booking enquiry form submitted successfully!'));
                $this->resetExcept(['activity', 'dateOfBooking']);
                $this->mount($this->activity);
            }
        } catch (\Exception $e) {
            $this->dispatch('error', __('Booking Failed Try Again'));
            report($e);
            return back()->withErrors(['message' => 'An error occurred while processing the booking.']);
        
    } finally {
        $this->isProcessing = false;
    }
    }


    public function calculate()
    {
        $activityCost = $this->activity->adult_price * $this->guest;

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
        $this->totalCost = $activityCost + $addonsCost;
    }

    public function render()
    {
        if(!empty($this->activity)) {
            $this->addons = Addon::with(['addonPhotos'])->get();
            if($this->activity && $this->activity->addons) {
                $addonIds = explode(',',$this->activity->addons);
                $this->activity->addon_names = $this->addons->whereIn('id',$addonIds);
            }
            $this->cakeAddonId = $this->addons->firstWhere('name','Cake on Arrival')?->id;
        }
        if (auth()->check()) {
            $this->name = auth()->user()->name ?? null;
            $this->mobile = auth()->user()->mobile ?? null;
            $this->email = auth()->user()->email ?? null;
           }
        return view('livewire.users.activity-book-form');
    }
}
