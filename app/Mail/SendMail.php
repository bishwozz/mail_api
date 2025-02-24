<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.sendMail')
                    ->subject($this->data['subject'])
                    ->with([
                        'subject' => $this->data['subject'], // Pass subject to view
                        'message_ht' => is_array($this->data['message']) 
                                        ? json_encode($this->data['message'], JSON_PRETTY_PRINT) 
                                        : $this->data['message'], // Ensure correct format
                    ]);
    }
}