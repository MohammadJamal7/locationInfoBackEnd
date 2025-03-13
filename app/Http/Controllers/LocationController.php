<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

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

        // Store the data in the database
        Location::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'ip' => $request->ip,
        ]);

        return response()->json(['message' => 'Location data stored successfully'], 201);
    }
}
