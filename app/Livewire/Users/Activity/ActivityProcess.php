<?php

namespace App\Livewire\Users\Activity;

use App\Models\Activities;
use App\Models\Booking;
use App\Models\RazorpayTransactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Razorpay\Api\Api;

class ActivityProcess extends Component
{
    public $step = 1;
    public $totalStep = 2;
    public $formData = [
        'medical' => [],
        'personal' => [],
    ];
    public $medicalConditions = [];
    public $chronicCondition;
    public $medicationsNo;
    public $guest, $slot , $activity_date, $total_cost, $activity, $med_con ,$paynow , $dateOfBooking;
    public $fname , $lname , $contact, $email, $econtact;
    public $dec;
    public $termsAccepted = false;


    protected $rules = [
        'medicalConditions' => 'required|array|min:1',
        'chronicCondition' => 'required_if:medicalConditions,!=,none of these|string',
        'medicationsNo' => 'required_if:medicalConditions,!=,none of these|string',
        'fname' => 'required|string',
        'lname' => 'required|string',
        'contact' => 'required|digits_between:10,11',
        'econtact' => 'required|digits_between:10,11',
        'dec' => 'required|accepted',

    ];

    public function __construct()
    {
        $this->dateOfBooking = Carbon::now()->format('d-m-Y');
    }

    public function mount($data) {
        if($data) {
            $this->guest = $data['guest'];
            $this->slot = $data['time_slot'];
            $this->activity_date = $data['arrival_date'];
            $this->total_cost = $data['total_cost'];
            $this->activity = Activities::find($data['activity_id']);
            $this->paynow = (int) 1000;
        }
    }
    public function updated()
    {
        $this->validateOnly('medicalConditions');
        if (!in_array('none of these', $this->medicalConditions)) {
            $this->validateOnly('chronicCondition');
            $this->validateOnly('medicationsNo');
    
            if ($this->chronicCondition == 'yes' || $this->medicationsNo == 'yes') {
                return false;
            }
        } elseif (in_array('none of these', $this->medicalConditions) && count($this->medicalConditions) > 1) {
            dd('Invalid selection: none of these cannot be selected with other conditions');
            return;
        }
    }

   protected function validate2()
{
    $this->validate([
        'fname' => 'required|string',
        'lname' => 'required|string',
        'contact' => 'required|string',
        'email' => 'required|email',
        'termsAccepted' => 'accepted',
    ]);
}

    
    public function nextStep()
    {
      if ($this->step == 1)
        {
            $this->validate2();
        }
        if ($this->step < $this->totalStep) {
            $this->step++;
        }
    }
    

    

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function submit()
    {

        $latestBooking = Booking::max('booking_id') ?? 0;
        $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);

        $booking = new Booking();
        $booking->fill([
            'booking_id' => $formattedBookingId,
            'table_id' => $this->activity['id'],
            'table_type' => 'services',
            'type' => 'activity',
            'room_id' => null,
            'food_choice' => null,
            'user_id' => auth()->user()->id ?? null,
            'name' => $this->fname.''.$this->lname,
            'mobile' => $this->contact,
            'email' => $this->email,
            'rate' => $this->activity['adult_price'] ?? 0.00,
            'address' => $this->activity['address'],
            'location' => null,
            'quantity' => $this->guest ?? 1,
            'price' => ($this->activity['adult_price'] ?? 0.00) * ($this->guest ?? 1),
            'adult' => $this->guest,
            'child' => 0,
            'start_at' => \Carbon\Carbon::parse($this->activity_date)->format('Y-m-d'),
            'slot' => $this->slot,
            'status' => 'pending',
        ]);
        $booking->save();
      

        $UserDeta = [
            'name' => $this->fname . ' ' . $this->lname,
            'email' => $this->email,
            'contact' => $this->contact,
            'razorpay_key' => env('RAZORPAY_API_KEY'),
        ];
        
        $bookNo = uniqid();


        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
        $orderData = [
            'amount' => $this->paynow * 100, 
            'currency' => 'INR',
            'receipt' => 'order_rcptid_' . $booking['booking_id'],
            'payment_capture' => 1,
        ];




        $order = $api->order->create($orderData);



        $transaction = RazorpayTransactions::create([
            'purpose' => 'Activity Booking',
            'booking_id' => $booking['booking_id'],
            'name' => $this->fname . ' ' . $this->lname,
            'email' => $this->email,
            'phone' => $this->contact,
            'payment_id' => null,
            'order_id' => $order['id'],
            'currency' => 'INR',
            'amount' => $this->paynow,
            'mode' => 'test',
            'json_response' => json_encode($order),
        ]);
        
        $this->dispatch('OpenPaymentSdk', [
            'order' => $order->toArray(),
            'userDetails' => $UserDeta,
        ]);      
    }

    public function paymentSuccess($response)
    {
        [$paymentId, $orderId, $signature] = $response;
        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
    
        try {
            $payment = $api->payment->fetch($paymentId);
    
            if ($this->processPayment($payment, $paymentId)) {
                $this->handleBooking($payment->order_id);
            } else {
                session()->flash('error', "Payment Failed Try Again");
            }
        } catch (\Exception $e) {
            session()->flash('error', "Payment Failed Try Again");
        }
    }

 public function paymentSuccessConfirmation($booking)
{
    foreach ([$booking->name, $booking->email, $booking->mobile] as $field) {
        if (is_string($field) && preg_match('/<[^>]*>/', $field)) {
            session()->flash('error', 'Spam detected. HTML tags are not allowed.');
            return;
        }
    }

    $mailData['subject'] = 'Activity Booking Confirmation - Andaman Bliss';
    $mailData['email'] = env('MAIL_FROM_ADDRESS', 'shivakumar@andamanbliss.com');
    $mailData['name'] = env('MAIL_FROM_NAME', 'AndamanBliss');
    $mailData['body'] = '';

    $mailData['body'] .= "Name: " . strip_tags(trim($booking->name)) . "<br/>";
    $mailData['body'] .= "Email: " . strip_tags(trim($booking->email)) . "<br/>";
    $mailData['body'] .= "Mobile: " . strip_tags(trim($booking->mobile)) . "<br/>";
    $mailData['body'] .= "Activity: " . strip_tags(trim($booking->activity_name)) . "<br/>";
    $mailData['body'] .= "Date: " . strip_tags(trim($booking->date)) . "<br/>";
    $mailData['body'] .= "Adults: {$booking->adult}<br/>";
    $mailData['body'] .= "Children: {$booking->child}<br/>";
    $mailData['body'] .= "Infants: {$booking->infant}<br/>";
    $mailData['body'] .= "Total Paid: ₹" . number_format($booking->amount, 2) . "<br/>";
    $mailData['body'] .= "LEAD URL: " . url()->current() . "<br/>";
    $mailData['info'] = "Note: don't share your login credentials & keep it confidential.";

    \Mail::send('emails.template', $mailData, function ($message) use ($mailData, $booking) {
        $message->subject($mailData['subject'])
                ->to('shivakumar@andamanbliss.com')
                ->cc('shivakumar@andamanbliss.com');
    });

    session()->flash('success', 'Booking confirmed! Confirmation email sent.');
}


    

    protected function processPayment($payment, $paymentId)
    {
        if ($payment->status === 'authorized' && !$payment->captured) {
            $payment->capture(['amount' => $payment->amount]);
            return true;
        }
    
        if ($payment->status === 'captured') {
            return true;
        }
    
        return false;
    }
    protected function handleBooking($orderId)
    {
        $transaction = DB::table('razorpay_transactions')->where('order_id', $orderId)->first();
    
        if ($transaction) {
            DB::table('razorpay_transactions')
                ->where('order_id', $orderId)
                ->update([
                    'status' => 'Captured',
                ]);
    
    
            $booking = DB::table('bookings')->where('booking_id', $transaction->booking_id)->first();
            if ($booking) {
                DB::table('bookings')->where('booking_id', $transaction->booking_id)->update([
                    'status' => 'active',
                ]);
                $this->paymentSuccessConfirmation($booking);
                return;
            }
        } else {
            session()->flash('error', "Payment Failed Try Again");
        }
    }

    public function paymentFailedSessionAlert()
    {
        session()->flash('Booking Failed Try Again ');
        return;
    }
    
    public function render()
    {
        return view('livewire.users.activity.activity-process');
    }
}
