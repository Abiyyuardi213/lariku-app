<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::orderBy('scheduled_at', 'desc')->get();
        return view('trainings.index', compact('trainings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'scheduled_at' => 'required|date',
            'location' => 'nullable|string',
            'target_distance_km' => 'nullable|numeric',
        ]);

        Training::create($validated);

        return redirect()->back()->with('success', 'Training scheduled.');
    }
}
