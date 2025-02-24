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
            'message' => 'required|array',
        ]);

        try {
            // Convert message array to JSON string (if needed)
            $data['message'] = json_encode($data['message']);
    
            // Send email using the Mailable
            Mail::to($data['to'])->send(new SendMail($data));
    
            return response()->json(['status' => true, 'message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Email could not be sent',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function test(){
        return view(
            'emails.test'
        );
    }
}
