<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
         // Start a query for the consultations
        $query = Consultation::where('user_id', auth()->id())
        ->with('professional'); // Assuming there's a relationship with professionals

        // Apply filters based on request input
        if ($request->filled('date')) {
            $query->where('date', $request->input('date'));
        }

        if ($request->filled('professional')) {
            $query->whereHas('professional', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('professional') . '%');
            });
        }

        if ($request->filled('specialty')) {
            $query->whereHas('professional', function ($q) use ($request) {
                $q->where('specialty', 'like', '%' . $request->input('specialty') . '%');
            });
        }

        // Execute the query and get the filtered consultations
        $consultations = $query->latest()->get();
        // Return the dashboard view with consultations data
        return view('dashboard', compact('consultations'));
    }
}
