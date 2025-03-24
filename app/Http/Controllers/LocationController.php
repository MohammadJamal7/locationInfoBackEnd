<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Location;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LocationController extends Controller
{

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'ip' => 'required|string',
           
        ]);
    
        try {
            // Store the location data in the database
            Location::create([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'ip' => $request->ip,
                
            ]);

            Mail::to('mj26653@gmail.com')->send(new SendEmail($request->latitude, $request->longitude, $request->ip));

            return response()->json(['message' => 'Location data stored successfully'], 201);
        } catch (\Exception $e) {
            // Log error and return a 500 response with the exception message
            Log::error('Error storing location data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to store location data.'], 500);
        }
    }
    
    
 // Method to activate the location collection
 public function activateLocation(Request $request)
 {
     // Find the setting (or create one if it doesn't exist)
     $setting = Setting::first();

     if ($setting) {
         $setting->is_location_enabled = true;
         $setting->save();
     } else {
         // If no setting is found, create a new one and activate location collection
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
      ],200);
  }
  
    
}
