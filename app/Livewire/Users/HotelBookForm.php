<?php

namespace App\Livewire\Users;

use App\Models\Addon;
use App\Models\Booking;
use App\Models\HotelRoomType;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;

class HotelBookForm extends Component
{
    public $hotel, $totalCost,  $child = 0, $rooms = 1;
    public $guest = 2;
    public $addon_quantities = [];
    public $addons, $cakeAddonId;
    public $arrival;
    public $isSubmitted = false;
    public $price;
    public $roomId;
    public $roomName;
    public $category;
    public $option = 1;
    public $name, $email, $dateOfBooking, $mobile, $HotelDetails;
    public $website = null;
    public $isProcessing = false;


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

    protected $listeners = ['updatePrice'];

    public function updatePrice($roomId, $price, $option)
    {
        $this->roomId = $roomId;
        $this->price = $price;
        $this->totalCost = $price;
        $roomcategory = HotelRoomType::find($roomId);
        $this->category = $roomcategory->name;
        $this->option = $option;
        $this->calculate();
    }

    public function mount($hotel)
    {

        if(!empty($hotel)){
        $this->hotel = $hotel;
        $this->roomId = $hotel->id;
        $this->price = $hotel->hotelRoomTypes[0]->breakfast_price;
        $this->category = $hotel->hotelRoomTypes[0]->name;
        $this->totalCost = $this->price;
        }
    }

    public function increment($type)
    {
        if ($type === 'room') {
            $this->rooms++;
        } elseif ($type === 'guests') {
            $this->guest++;
            $this->adjustRoomsBasedOnGuests();
        } elseif ($type === 'child') {
            $this->child++;
        }
        $this->calculate();
    }

    public function decrement($type)
    {
        if ($type === 'room' && $this->rooms > 1) {
            $this->rooms--;
        } elseif ($type === 'guests' && $this->guest > 1) {
            $this->guest--;
            $this->adjustRoomsBasedOnGuests();
        } elseif ($type === 'child' && $this->child > 0) {
            $this->child--;
        }
        $this->calculate();
    }

    private function adjustRoomsBasedOnGuests()
    {
        $this->rooms = ceil($this->guest / 3);
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
    public function toggleAddon($addonId)
    {
        if (isset($this->addon_quantities[$addonId])) {
            unset($this->addon_quantities[$addonId]);
        } else {
            $this->addon_quantities[$addonId] = 1;
        }

        $this->calculate();
    }
    public function calculate()
    {
        $roomCost = $this->price * $this->rooms;
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
        $this->totalCost = $roomCost + $addonsCost;
    }

    public function submit()
    {
        $this->isSubmitted = true;
        $addonData = $this->getAddonNamesWithQuantities();
        $data = [
            'guest' => $this->guest,
            'child' => $this->child,
            'addon' => $addonData,
            'totalcost' => $this->totalCost,
            'food' => $this->option,       
            'category' => $this->category,
            'price' => $this->price,
        ];
        $this->HotelDetails = $data;
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
                $mergedData = array_merge($this->HotelDetails, $this->hotel->toArray(), $data);
    
                $addonDetailsArray = [];
                if (!empty($this->HotelDetails['addon']) && is_array($this->HotelDetails['addon'])) {
                    $addonDetailsArray = array_map(function ($addon) {
                        return [
                            'id' => $addon['id'],
                            'name' => $addon['name'],
                            'quantity' => $addon['quantity'],
                            'price' => $addon['price'],
                        ];
                    }, $this->HotelDetails['addon']);
                }
                $mergedData['addon'] = $addonDetailsArray;
                $latestBooking = Booking::max('booking_id') ?? 0;
                $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);
    
                $hotelRoomType = HotelRoomType::find($this->roomId);
                $foodChoice = $this->getFoodChoice($this->option);
                $adultPrice = $foodChoice . '_price';
    
                $booking = new Booking();
                $booking->fill([
                    'booking_id' => $formattedBookingId,
                    'table_id' => $mergedData['id'],
                    'table_type' => 'services',
                    'type' => 'hotel',
                    'room_id' => $this->roomId,
                    'food_choice' => $foodChoice,
                    'user_id' => auth()->user()->id ?? null,
                    'name' => $mergedData['name'],
                    'mobile' => $mergedData['mobile'],
                    'email' => $mergedData['email'],
                    'rate' => $mergedData['price'] ?? 0.00,
                    'quantity' => $this->rooms ?? 1,
                    'price' => ($mergedData['price'] ?? 0.00) * ($this->rooms ?? 1),
                    'adult' => $this->guest,
                    'child' => $this->child,
                    'start_at' => date('Y-m-d', strtotime($this->dateOfBooking)),
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
                            'type' => 'hotel',
                            'room_id' => $this->roomId,
                            'food_choice' => $foodChoice,
                            'user_id' => auth()->user()->id ?? null,
                            'name' => $mergedData['name'],
                            'mobile' => $mergedData['mobile'],
                            'email' => $mergedData['email'],
                            'rate' => $addon['price'],
                            'quantity' => $addon['quantity'],
                            'price' => $addon['price'] * $addon['quantity'],
                            'adult' => 0,
                            'child' => 0,
                            'start_at' => date('Y-m-d', strtotime($this->dateOfBooking)),
                            'status' => 'active',
                        ]);
                        $addonBooking->save();
                    }
                }



                $mailData['subject'] =  'Hotel Enquiry Form';
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
                if ($this->hotel['name']) {
                    $mailData['body'] .= "Hotel : {$this->hotel['name']}<br/>";
                }

                if($this->rooms) {
                    $mailData['body'] .= "Rooms : {$this->rooms}<br/>";
                }

                if ($this->guest) {
                    $mailData['body'] .= "Adults: {$this->guest} <br/> Child: {$this->child}<br/>";
                }
                
            
                if ($this->dateOfBooking) {
                    $mailData['body'] .= "Date of Booking: {$this->dateOfBooking}<br/>";
                }
              
                if (!empty($this->HotelDetails['addon']) && is_array($this->HotelDetails['addon'])) {
                    $mailData['body'] .= "<br/>Addons:<br/>";
                    foreach ($this->HotelDetails['addon'] as $addon) {
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
                    ->to('info@andamanbliss.com')
                    ->cc(['amitmandal@andamanbliss.com']);
                }); 




                $this->dispatch('success', __('Booking enquiry form submitted successfully!'));
                $this->resetExcept(['hotel', 'dateOfBooking']);
                $this->mount($this->hotel);
            }
        } catch (\Exception $e) {
            $this->dispatch('error', __('Booking Failed Try Again'));
            report($e);
            return back()->withErrors(['message' => 'An error occurred while processing the booking.']);
        }
        finally {
            $this->isProcessing = false;
        }
    }
    
    private function getFoodChoice($food)
    {
        return match ($food) {
            'Option 1' => 'breakfast',
            'Option 2' => 'dinner',
            'Option 3' => 'lunch',
            default => null,
        };
    }
    


    public function render()
    {
        if (!empty($this->hotel)) {
            $this->addons = Addon::with(['addonPhotos'])->get();
            if ($this->hotel && $this->hotel->addons) {
                $addonIds = explode(',', $this->hotel->addons);
                $this->hotel->addon_names = $this->addons->whereIn('id', $addonIds);
            }
            $this->cakeAddonId = $this->addons->firstWhere('name', 'Cake on Arrival')?->id;
        }
        if (auth()->check()) {
            $this->name = auth()->user()->name ?? null;
            $this->mobile = auth()->user()->mobile ?? null;
            $this->email = auth()->user()->email ?? null;
           }
        return view('livewire.users.hotel-book-form');
    }

    public function hydrate()
    {
        if ($this->isSubmitted) {
            $this->resetErrorBag();
            $this->resetValidation();
        }
    }
}
