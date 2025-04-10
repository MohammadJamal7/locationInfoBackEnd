<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilteringController extends Controller
{
    public function dashboard(Request $request)
    {
        
        $query = Location::query();
        
        // Apply date filter if provided (single date)
        if ($request->has('selected_date') && $request->selected_date) {
            $selectedDate = Carbon::parse($request->selected_date);
            $query->whereDate('created_at', $selectedDate);
        }
        
        // Apply partial IP filter if provided
        if ($request->has('ip') && $request->ip) {
            // Using 'like' to match partial IP addresses
            $query->where('ip', 'like', '%' . $request->ip . '%');
        }
        
        // Get statistics
        $stats = [
            'total' => Location::count(),
            'today' => Location::whereDate('created_at', Carbon::today())->count(),
            'this_week' => Location::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'this_month' => Location::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count(),
        ];
        
        // Get unique IPs for dropdown filter
        $users_emails = User::where('role', 'user')->select('email')->distinct()->pluck('email');
        
        // Fetch locations with pagination
        $locations = $query->orderBy('created_at', 'desc')->paginate(10);
        $adminEmail = Setting::first()->email??'example@email.com';
       
        
        return view('admin.dashboard', compact('locations', 'stats', 'users_emails','adminEmail'));
    }

    
    public function storeAdminEmail(Request $request){
           $request->validate([
            'email' => 'required|email',
        ]);

        $setting = Setting::first();
        if ($setting) {
            $setting->email = $request->email;
            $setting->save();
        } else {
            Setting::create([
                'email' => $request->email
            ]);
        }
        return redirect()->back()->with('success', 'تم تحديث البريد الإلكتروني بنجاح!');
    }
}
