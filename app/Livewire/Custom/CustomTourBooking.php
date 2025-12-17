<?php

namespace App\Livewire\Custom;

use Livewire\Component;

class CustomTourBooking extends Component
{
    public $duration, $adults = 1, $children = 0, $infants = 0;
    public $minPrice = 8000, $maxPrice = 15000;
    public $selectedMinPrice = 8000, $selectedMaxPrice = 15000;
    public $journeyDate, $hotelCategory, $travelType, $flightOption = 'have-tickets';
    public $fullname, $email, $phone, $message;

    public function increment($field)
    {
        if ($field === 'adults' && $this->adults < 10) $this->adults++;
        elseif ($field === 'children' && $this->children < 6) $this->children++;
        elseif ($field === 'infants' && $this->infants < 4) $this->infants++;
    }

    public function decrement($field)
    {
        if ($field === 'adults' && $this->adults > 1) $this->adults--;
        elseif ($field === 'children' && $this->children > 0) $this->children--;
        elseif ($field === 'infants' && $this->infants > 0) $this->infants--;
    }

    public function updatePriceRange($min, $max)
    {
        $min = (int) max(1000, min($min, 1000000));
        $max = (int) min(1000000, max($max, 1000));
        if ($min > $max - 500) {
            $min = $max - 500;
        }
        if ($this->minPrice !== $min || $this->maxPrice !== $max) {
            $this->minPrice = $min;
            $this->maxPrice = $max;
            $this->selectedMinPrice = $min;
            $this->selectedMaxPrice = $max;
            $this->dispatch('price-range-updated', min: $min, max: $max);
        }
    }

    public function submit()
    {
        $this->validate([
            'duration' => 'required',
            'adults' => 'required|integer|min:1|max:10',
            'children' => 'required|integer|min:0|max:6',
            'infants' => 'required|integer|min:0|max:4',
            'minPrice' => 'required|integer|min:1000',
            'maxPrice' => 'required|integer|max:1000000|gte:minPrice',
            'journeyDate' => 'required|date',
            'hotelCategory' => 'required|in:1,2,3,4,5,7',
            'travelType' => 'required',
            'flightOption' => 'required|in:have-tickets,need-tickets',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:12',
            'message' => 'nullable|string|max:1000',
        ]);
    
        $mailData = [
            'subject' => 'New Custom Tour Enquiry',
            'email' => env('MAIL_FROM_ADDRESS', 'shivakumar@andamanbliss.com'),
            'name' => env('MAIL_FROM_NAME', 'AndamanBliss'),
            'body' => '',
            'info' => "Note: Don’t share your login credentials & keep them confidential.",
        ];
    
        $mailData['body'] .= "<strong>Personal Information</strong><br/>";
        $mailData['body'] .= "Full Name: {$this->fullname}<br/>";
        $mailData['body'] .= "Email: {$this->email}<br/>";
        $mailData['body'] .= "Phone: {$this->phone}<br/><br/>";    
        $mailData['body'] .= "<strong>Tour Preferences</strong><br/>";
        $mailData['body'] .= "Duration: {$this->duration} days<br/>";
        $mailData['body'] .= "Adults: {$this->adults}<br/>";
        $mailData['body'] .= "Children: {$this->children}<br/>";
        $mailData['body'] .= "Infants: {$this->infants}<br/>";
        $mailData['body'] .= "Journey Date: {$this->journeyDate}<br/>";
        $mailData['body'] .= "Hotel Category: Star {$this->hotelCategory}<br/>";
        $mailData['body'] .= "Tour Type: " . ucfirst($this->travelType) . "<br/>";
        $mailData['body'] .= "Flight Tickets: " . ($this->flightOption === 'need-tickets' ? 'Need Tickets' : 'Have Tickets') . "<br/>";
        $mailData['body'] .= "Budget Range: ₹" . number_format($this->minPrice) . " to ₹" . number_format($this->maxPrice) . "<br/><br/>";
    
        if (!empty($this->message)) {
            $mailData['body'] .= "<strong>Additional Message</strong><br/>";
            $mailData['body'] .= nl2br(e($this->message)) . "<br/><br/>";
        }
    
        $mailData['body'] .= "<hr><small>{$mailData['info']}</small>";
    
        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])
                    ->to('shivakumar@andamanbliss.com');
        });
        
        $this->dispatch('success', __('Booking submitted successfully!'));
       $this->reset();
    }
    

    public function render()
    {
        return view('livewire.custom.custom-tour-booking');
    }
}