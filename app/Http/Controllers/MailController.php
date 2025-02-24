<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail; // We will create this Mailable class next

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // return $request;
        $data = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            // Send email using a Mailable
            Mail::to($data['to'])->send(new SendMail($data));

            return response()->json(['status' =>True, 'message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' =>False,'message' => 'Email could not be sent', 'message' => $e->getMessage()], 500);
        }
    }

    public function test(){
        return view(
            'emails.test'
        );
    }
}
