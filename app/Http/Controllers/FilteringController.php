<?php
namespace App\Http\Controllers;

use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilteringController extends Controller
{
    public function dashboard(Request $request)
    {
        // Base query for locations - return all by default
        $query = Location::query();
        
        // Apply date filter if provided (single date)
        if ($request->has('selected_date') && $request->selected_date) {
            $selectedDate = Carbon::parse($request->selected_date);
            $query->whereDate('created_at', $selectedDate);
        }
        
        // Apply IP filter if provided
        if ($request->has('ip') && $request->ip) {
            $query->where('ip', $request->ip);
        }
        
        // Get statistics
        $stats = [
            'total' => Location::count(),
            'today' => Location::whereDate('created_at', Carbon::today())->count(),
            'this_week' => Location::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'this_month' => Location::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count(),
        ];
        
        // Get unique IPs for dropdown filter
        $uniqueIps = Location::select('ip')->distinct()->pluck('ip');
        
        // Fetch locations with pagination
        $locations = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.dashboard', compact('locations', 'stats', 'uniqueIps'));
    }
    
 
   
}
