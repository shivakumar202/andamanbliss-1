<?php

namespace App\Livewire\Additional;

use App\Models\Activities;
use App\Models\Booking;
use App\Models\RazorpayTransactions;
use Livewire\Component;
use Razorpay\Api\Api;

class Upsale extends Component
{
    public $step = 0;
    public $totalSteps = 2;
    public $adult = 1;
    public $child = 0;
    public $activities = [];
    public $selectedActivities = [];
    public $activityId = null;
    public $activityDate;
    public $serviceTax = 7;
    public $serviceCost = 0;
    public $activityCost = 0;
    public $totalCost = 0;
    public $adultCost = 0;
    public $childCost = 0;
    public $payDetails = null;
    protected $pay_id = null;

    public function mount()
    {
        $this->pay_id = request()->pay_id;
        $this->payDetails = RazorpayTransactions::where('payment_id', $this->pay_id)->first();
        if (now()->greaterThan(session('time_out'))) {
            session()->forget(['time_out', 'current_step', 'activity_ids']);
        }

        $this->step = session()->get('current_step', 0);

        if ($this->step == 1 && session()->has('activity_ids')) {
            $this->activities = Activities::whereIn(
                'id',
                session('activity_ids')
            )->get();
        }
    }

    public function increaseAdult()
    {
        $this->adult++;
    }

    public function decreaseAdult()
    {
        if ($this->adult > 1) {
            $this->adult--;
        }
    }

    public function increaseInfant()
    {
        $this->child++;
    }

    public function decreaseInfant()
    {
        if ($this->child > 0) {
            $this->child--;
        }
    }


    public function addActivity()
    {
        $this->selectedActivities[$this->activityId] = [
            'date' => $this->activityDate,
            'adult' => (int) $this->adult,
            'child' => (int) $this->child,
        ];

        session()->put('selected_activities', $this->selectedActivities);
        $this->calculateCost();
        $this->dispatch('close-activity-modal');
    }

    public function editActivity($id)
    {
        if (!isset($this->selectedActivities[$id])) {
            return;
        }

        $data = $this->selectedActivities[$id];

        $this->activityId = $id;
        $this->activityDate = $data['date'];
        $this->adult = (int) $data['adult'];
        $this->child = (int) $data['child'];
        $this->calculateCost();
        // Tell browser to open modal
        $this->dispatch('open-activity-modal');
    }


    public function removeActivity($id)
    {
        unset($this->selectedActivities[$id]);

        // Optional: reset form if current edited item is removed
        if ($this->activityId == $id) {
            $this->reset(['activityId', 'activityDate', 'adult', 'child']);
            $this->adult = 1;
            $this->child = 0;
        }
        $this->calculateCost();
    }


    public function openActivity($id)
    {
        $this->activityId = $id;
        $this->adult = 1;
        $this->child = 0;
        $this->activityDate = now()->toDateString();
    }

    public function nextStep()
    {
        $this->step++;
        session()->put('time_out', now()->addMinutes(1));
        session()->put('current_step', $this->step);

        if ($this->step == 1) {

            $activities = Activities::where(function ($query) {
                $query->where('location', 'LIKE', '%Elephanta Beach%')
                    ->orWhere('location', 'LIKE', '%Havelock Island%');
            })
                ->where('status', 1)
                ->where('live_booking', 1)
                ->where('featured', 1)
                ->get();

            $this->activities = $activities;

            session()->put('activity_ids', $activities->pluck('id')->toArray());
        }
    }

    protected function calculateCost()
    {
        $this->adultCost = 0;
        $this->childCost = 0;

        foreach ($this->selectedActivities as $activityId => $data) {

            $activity = Activities::find($activityId);

            if (!$activity) {
                continue;
            }

            $this->adultCost += $activity->adult_cost * $data['adult'];
            $this->childCost += $activity->child_cost * $data['child'];
        }

        $this->activityCost = $this->adultCost + $this->childCost;

        $taxAmount = ($this->activityCost * $this->serviceTax) / 100;
        $this->serviceCost = $taxAmount;
        $this->totalCost = $this->activityCost + $taxAmount;
    }

    public function submit()
    {
        $activities = $this->activities;
        $payDetail = $this->payDetails;
        $ticketcode = null;
        $finalActivities = collect($this->selectedActivities)->map(function ($data, $id) use ($activities) {

            $activity = $this->activities->firstWhere('id', $id);

            if (!$activity)
                return null;

            return [
                'id' => $activity->id,
                'name' => $activity->service_name,
                'date' => $data['date'],
                'adult' => $data['adult'],
                'child' => $data['child'],
                'adult_cost' => $activity->adult_cost,
                'child_cost' => $activity->child_cost,
                'total_cost' =>
                    ($activity->adult_cost * $data['adult']) +
                    ($activity->child_cost * $data['child']),
            ];

        })->filter()->values();



        foreach ($finalActivities as $act) {
            print_r($act);
            $latestBooking = Booking::max('booking_id') ?? 0;
            $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);
            $activity = Activities::findOrFail($act['id']);
            $booking = new Booking();
            $booking->fill([
                'booking_id' => $formattedBookingId,
                'table_id' => $act['id'],
                'table_type' => 'activity',
                'type' => 'activity',
                'room_id' => null,
                'food_choice' => null,
                'user_id' => auth()->user()->id ?? null,
                'name' => $payDetail->name,
                'mobile' => $payDetail->phone,
                'email' => $payDetail->email,
                'rate' => $activity->adult_cost ?? 0.00,
                'address' => $activity->location,
                'location' => $activity->location,
                'quantity' => ($act['guest'] ?? 0) + ($act['child'] ?? 0),
                'price' => $act['total_cost'],
                'adult' => $act['guest'] ?? 0,
                'child' => $act['child'] ?? 0,
                'start_at' => \Carbon\Carbon::parse($act['arrival_date'])->format('Y-m-d'),
                'end_at' => isset($act['time_slot']) && strpos($act['time_slot'], '-') !== false
                    ? \Carbon\Carbon::createFromFormat('H:i', trim(explode('-', $act['time_slot'])[0]))->format('H:i')
                    : null,
                'status' => 'pending',
            ]);
            $booking->save();


            $lastTwoDigits = substr($booking->mobile, -2);
            $bdate = \Carbon\Carbon::parse($booking->start_date)->format('dm');
            $prefix = 'AB';
            $ticketcode = $prefix . $bdate . $lastTwoDigits . $booking->id;
        }

        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));

        $orderData = [
            'amount' => ((float) $this->totalCost * 100), // in paisa
            'currency' => 'INR',
            'receipt' => 'order_rcptid_upsale',
            'payment_capture' => 1,
        ];

        $order = $api->order->create($orderData);

        RazorpayTransactions::create([
            'purpose' => 'Upsale Activity Booking',
            'booking_id' => $booking->booking_id,
            'name' => $payDetail->name,
            'email' => $payDetail->email,
            'phone' => $payDetail->phone,
            'payment_id' => null,
            'order_id' => $order['id'],
            'tax' => $this->serviceCost,
            'currency' => 'INR',
            'amount' => $this->totalCost,
            'mode' => 'test',
            'json_response' => json_encode($order),
        ]);

        $UserDeta = [
            'name' => $payDetail->name,
            'email' => $payDetail->email,
            'contact' => $payDetail->phone,
            'razorpay_key' => env('RAZORPAY_API_KEY'),
        ];

        $this->dispatch('OpenPaymentSdk', [
            'order' => $order->toArray(),
            'userDetails' => $UserDeta,
        ]);
    }


    public function render()
    {
        return view('livewire.additional.upsale');
    }
}
