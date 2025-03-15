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
    
    /**
     * Show details for a specific location
     */
    public function show($id)
    {
        $location = Location::findOrFail($id);
        return view('admin.location-details', compact('location'));
    }
    
    /**
     * Delete a location
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'تم حذف الموقع بنجاح');
    }
    
    /**
     * Export locations as CSV
     */
    public function export(Request $request)
    {
        // Base query for locations with filters
        $query = Location::query();
        
        // Apply the same filters as in the dashboard
        if ($request->has('selected_date') && $request->selected_date) {
            $selectedDate = Carbon::parse($request->selected_date);
            $query->whereDate('created_at', $selectedDate);
        }
        
        if ($request->has('ip') && $request->ip) {
            $query->where('ip', $request->ip);
        }
        
        $locations = $query->orderBy('created_at', 'desc')->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="مواقع_تصدير_' . date('Y-m-d') . '.csv"',
        ];
        
        $callback = function() use ($locations) {
            $file = fopen('php://output', 'w');
            // UTF-8 BOM for Excel to properly display Arabic
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['المعرف', 'خط العرض', 'خط الطول', 'عنوان IP', 'تاريخ الإنشاء']);
            
            foreach ($locations as $location) {
                fputcsv($file, [
                    $location->id,
                    $location->latitude,
                    $location->longitude,
                    $location->ip,
                    $location->created_at
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
