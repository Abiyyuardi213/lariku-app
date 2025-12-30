<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'asc')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:road,trail',
            'distance_category' => 'required|string',
            'location' => 'required|string',
            'event_date' => 'required|date',
            'registration_price' => 'nullable|numeric',
            'early_bird_deadline' => 'nullable|date',
            'status' => 'required|in:wishlist,registered,done',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $event->load('budgets');
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:road,trail',
            'distance_category' => 'required|string',
            'location' => 'required|string',
            'event_date' => 'required|date',
            'registration_price' => 'nullable|numeric',
            'early_bird_deadline' => 'nullable|date',
            'status' => 'required|in:wishlist,registered,done',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }
}
