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
        return $this->view('emails.sendMail') // The email view
                    ->subject($this->data['subject'])
                    ->with([
                        'message' => $this->data['message'],
                    ]);
    }
}
