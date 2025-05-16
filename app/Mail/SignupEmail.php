<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignupEmail extends Mailable
{
    
    //Pass the data here
    public $data;
    use Queueable, SerializesModels;
    public $details;

    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
  

    public function build()
    {
        // Define our Subject

        $subject = $this->data['name']." ".'sent a Message on  Registration';

        return $this->markdown(view:'emails.signup')->with(['data'=>$this->data]);  
        
    }

    
    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
