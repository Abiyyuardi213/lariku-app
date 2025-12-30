<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Training;
use App\Models\Budget;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        $nextTraining = Training::where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at', 'asc')
            ->first();

        // Calculate budget stats
        $totalEstimated = Budget::sum('estimated_amount');
        $totalActual = Budget::sum('actual_amount');

        return view('dashboard', compact('upcomingEvents', 'nextTraining', 'totalEstimated', 'totalActual'));
    }
}
