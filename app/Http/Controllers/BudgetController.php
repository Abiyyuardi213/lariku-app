<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Event;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'item' => 'required|string',
            'estimated_amount' => 'required|numeric',
            'actual_amount' => 'nullable|numeric',
            'is_paid' => 'boolean',
        ]);

        $event->budgets()->create($validated);

        return redirect()->back()->with('success', 'Budget item added.');
    }

    public function update(Request $request, Budget $budget)
    {
        $validated = $request->validate([
            'actual_amount' => 'nullable|numeric',
            'is_paid' => 'boolean',
        ]);

        $budget->update($validated);
        return back();
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();
        return back();
    }
}
