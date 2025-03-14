<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{


    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'ip' => 'required|string',
            'country' => 'string',
            'city' => 'string',
        ]);

        // Store the data in the database
        Location::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'ip' => $request->ip,
            'country' => $request->country,
            'city' => $request->city,
        ]);

        return response()->json(['message' => 'Location data stored successfully'], 201);
    }

    
    // public function store(Request $request)
    // {
    //     // Validate incoming request data
    //     $request->validate([
    //         'latitude' => 'required|numeric',
    //         'longitude' => 'required|numeric',
    //         'ip' => 'required|string',
    //     ]);

    //     // Store the data in the database
    //     Location::create([
    //         'latitude' => $request->latitude,
    //         'longitude' => $request->longitude,
    //         'ip' => $request->ip,
    //     ]);

    //     // Prepare email content
    //     $toEmail = 'mj26653@gmail.com'; // Set the recipient email address here
    //     $subject = 'بيانات الموقع الجديد'; // Subject in Arabic
    //     $message = "
    //         <html>
    //         <head>
    //             <title>بيانات الموقع الجديد</title>
    //             <style>
    //                 body {
    //                     font-family: 'Arial', sans-serif;
    //                     background-color: #f4f4f4;
    //                     color: #333;
    //                     padding: 20px;
    //                 }
    //                 .container {
    //                     width: 100%;
    //                     max-width: 600px;
    //                     margin: 0 auto;
    //                     background-color: #fff;
    //                     padding: 20px;
    //                     border-radius: 8px;
    //                     box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    //                 }
    //                 h1 {
    //                     text-align: center;
    //                     color: #4CAF50;
    //                 }
    //                 p {
    //                     font-size: 16px;
    //                     line-height: 1.6;
    //                     margin-bottom: 10px;
    //                 }
    //                 .data-section {
    //                     background-color: #f9f9f9;
    //                     padding: 10px;
    //                     border-left: 4px solid #4CAF50;
    //                     margin-bottom: 20px;
    //                 }
    //                 .footer {
    //                     text-align: center;
    //                     font-size: 12px;
    //                     color: #777;
    //                 }
    //             </style>
    //         </head>
    //         <body>
    //             <div class='container'>
    //                 <h1>بيانات الموقع الجديد</h1>
    //                 <p>تم استلام بيانات الموقع الجديد بنجاح.</p>
    //                 <div class='data-section'>
    //                     <p><strong>خط العرض:</strong> {$request->latitude}</p>
    //                     <p><strong>خط الطول:</strong> {$request->longitude}</p>
    //                     <p><strong>عنوان الـ IP:</strong> {$request->ip}</p>
    //                 </div>
    //                 <p class='footer'>هذا البريد الإلكتروني تم إرساله تلقائيًا بواسطة النظام.</p>
    //             </div>
    //         </body>
    //         </html>
    //     ";

    //     // Set the headers
    //     $headers = "MIME-Version: 1.0" . "\r\n";
    //     $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
    //     $headers .= "From: no-reply@yourdomain.com" . "\r\n"; // Set from address

    //     // Send the email using PHP's mail() function
    //     if (mail($toEmail, $subject, $message, $headers)) {
    //         return response()->json(['message' => 'تم تخزين بيانات الموقع وإرسال البريد الإلكتروني بنجاح'], 201);
    //     } else {
    //         return response()->json(['message' => 'فشل في إرسال البريد الإلكتروني'], 500);
    //     }
    // }


    public function sendStaticEmail()
    {
        // Static data
        $to = "mj26653@gmail.com";
        $subject = "Test Email from Laravel";
        $message = "This is a test email with static data.\n\nRegards,\nYour Application";
        $headers = "From: sender@example.com\r\n" .
                  "Reply-To: sender@example.com\r\n" .
                  "X-Mailer: PHP/" . phpversion();

        // Simulate sending by logging the data (instead of using mail())
        Log::info("Email would be sent:", [
            'to' => $to,
            'subject' => $subject,
            'message' => $message,
            'headers' => $headers
        ]);

        // Pretend it was sent successfully
        return response()->json(['message' => 'Email simulated successfully']);
    }
}
