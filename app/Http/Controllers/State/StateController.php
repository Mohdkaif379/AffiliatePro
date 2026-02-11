<?php

namespace App\Http\Controllers\State;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    /**
     * Display a listing of states
     */
    public function index()
    {
        $states = State::latest()->get();
        return view('states.index', compact('states'));
    }

    /**
     * Show the form for creating a new state
     */
    public function create()
    {
        return view('states.create');
    }

    /**
     * Store a newly created state in database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        State::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('states.index')
            ->with('success', 'State created successfully');
    }

    /**
     * Show the form for editing the specified state
     */
    public function edit(State $state)
    {
        return view('states.edit', compact('state'));
    }

    /**
     * Update the specified state in database
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        $state->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('states.index')
            ->with('success', 'State updated successfully');
    }

    /**
     * Remove the specified state from database
     */
    public function destroy(State $state)
    {
        $state->delete();

        return redirect()
            ->route('states.index')
            ->with('success', 'State deleted successfully');
    }
}
