<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Location;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LocationController extends Controller
{

  
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'ip' => 'required|string',
            'address' => 'required|string',
        ]);
    
        try {
            // Store the location data
            Location::create([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'ip' => $request->ip,
                'address' => $request->address,
            ]);
    
            // Send email to admin
            $adminEmail = Setting::first()->email;
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new SendEmail($request->latitude, $request->longitude, $request->address, $request->ip));
            }
    
            return response()->json([
                'message' => 'Location data stored successfully'
            ], 201);
        } catch (Exception $e) {
            Log::error('Error storing location data: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
    
    
 // Method to activate the location collection
 public function activateLocation(Request $request)
 {
   
     $setting = Setting::first();

     if ($setting) {
         $setting->is_location_enabled = true;
         $setting->save();
     } else {
         
         Setting::create([
             'is_location_enabled' => true
         ]);
     }

     return redirect()->back()->with('success', 'تم تفعيل جمع البيانات بنجاح!');
 }


 // Method to deactivate the location collection
 public function deactivateLocation(Request $request)
 {
     $setting = Setting::first();

     if ($setting) {
         $setting->is_location_enabled = false;
         $setting->save();
     }

     return redirect()->back()->with('success', 'تم إلغاء تفعيل جمع البيانات بنجاح!');
 }
    
  // In your LocationController.php
  public function getLocationStatus()
  {
      $setting = Setting::first();
      return response()->json([
          'status' => $setting ? $setting->is_location_enabled : false
      ], 200);
  }
  
  public function deleteAll(){
    Location::truncate();
    return redirect()->back()->with('success', 'تم حذف جميع البيانات بنجاح!');
  }  


  function send(){
    try {
        $adminEmail = Setting::first()->email;
        if ($adminEmail) {
            Mail::to($adminEmail)->send(new SendEmail(651651, 65165165, 545656, "address"));
        }
        return dd("Test email sent successfully!");
    } catch (Exception $e) {
       dd("Error sending email: " . $e->getMessage());
    }
    
}


function testloc(){

    $latitude = 35.736583;
    $longitude = 32.573193;

    // Nominatim Reverse Geocoding API URL
    $geocodeUrl = "https://nominatim.openstreetmap.org/reverse?lat=$latitude&lon=$longitude&format=json&addressdetails=1&accept-language=ar";

    
    $options = [
        "http" => [
            "header" => "User-Agent: MyApp/1.0 (myemail@example.com)"  // Customize this string with your app info
        ]
    ];

    $context = stream_context_create($options);

    // Make the API request
    $response = file_get_contents($geocodeUrl, false, $context);
    $data = json_decode($response, true);

    // Check if the response is valid and contains address
    if (isset($data['address'])) {
        $address = $data['address'];
        // dd("The address is: " . $address['road'] . ", " . $address['city'] . ", " . $address['country']);
        dd($address);
    } else {
        dd("Unable to get location.");
    }
}


}