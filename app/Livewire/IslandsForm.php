<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;


class IslandsForm extends Component
{
    public $package = '';
    public $journey_date;
    public $adult_count = 1;
    public $child_count = 0;
    public $infant_count = 0;
    public $name;
    public $mobile;
    public $url;
    public $email;
    public $website = '';

    protected $rules = [
        'package' => 'required',
        'journey_date' => 'required|date|after_or_equal:today',
        'adult_count' => 'required|integer|min:1',
        'child_count' => 'nullable|integer|min:0',
        'infant_count' => 'nullable|integer|min:0',
        'name' => 'required|string|max:255',
        'mobile' => 'required|integer|min:10',
        'email' => 'required|email',

    ];

    public function increment($field)
    {
        $this->$field++;
    }

    public function decrement($field)
    {
        if ($this->$field > 0) {
            $this->$field--;
        }
    }
    public function mount()
    {        $this->url = url()->current();
}

    public function submit()
    {
        if (!property_exists($this, 'website') || !empty($this->website)) {
            session()->flash('error', 'Spam detected. Submission blocked.');
            return;
        }


        foreach ([$this->name, $this->email, $this->mobile, $this->package] as $field) {
            if (is_string($field) && preg_match('/<[^>]*>/', $field)) {
                session()->flash('error', 'Spam detected. HTML tags are not allowed.');
                return;
            }
        }

        $this->validate();

        $mailData['subject'] = 'Island Booking Inquiry Form';
        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
        $mailData['name'] = env('MAIL_FROM_NAME', 'AndamanBliss');
        $mailData['body'] = '';

        if ($this->name) {
            $mailData['body'] .= "Name: " . strip_tags(trim($this->name)) . "<br/>";
        }
        if ($this->email) {
            $mailData['body'] .= "Email: " . strip_tags(trim($this->email)) . "<br/>";
        }
        if ($this->mobile) {
            $mailData['body'] .= "Mobile: " . strip_tags(trim($this->mobile)) . "<br/>";
        }
        if ($this->package) {
            $mailData['body'] .= "Tour: " . strip_tags(trim($this->package)) . "<br/>";
        }
        if ($this->adult_count !== null) {
            $mailData['body'] .= "Adult: {$this->adult_count}<br/>";
            $mailData['body'] .= "Child: {$this->child_count}<br/>";
            $mailData['body'] .= "Infant: {$this->infant_count}<br/>";
        }
        if ($this->journey_date) {
            $mailData['body'] .= "Date: {$this->journey_date}<br/>";
        }
        $mailData['body'] .= "LEAD URL: {$this->url}<br/>";
        $mailData['info'] = "Note: don't share your login credentials & keep it confidential.";

        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])
                ->to('info@andamanbliss.com')
                ->cc('amitmandal@andamanbliss.com');
        });

        session()->flash('success', 'Inquiry sent successfully!');
        $this->reset();
        $this->adult_count = 1;
    }
    public function render()
    {
        return view('livewire.islands-form');
    }
}
