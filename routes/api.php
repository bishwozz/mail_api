<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

Route::post('/send-email', [MailController::class, 'sendEmail']);

Route::get('/test', function () {
    return response()->json(['message' => 'API works!']);
});