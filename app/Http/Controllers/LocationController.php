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
           
        ]);
    
        try {
            // Store the location data in the database
            Location::create([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'ip' => $request->ip,
                
            ]);
    
            return response()->json(['message' => 'Location data stored successfully'], 201);
        } catch (\Exception $e) {
            // Log error and return a 500 response with the exception message
            Log::error('Error storing location data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to store location data.'], 500);
        }
    }
    
    
   

    
}
