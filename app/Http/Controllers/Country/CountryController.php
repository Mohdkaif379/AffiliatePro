<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the countries.
     */
    public function index()
    {
        $countries = Country::latest()->get();
        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new country.
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created country in database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_name' => 'required|string|max:255',
            'country_code' => 'nullable|string|max:10',
            'status'       => 'required|in:active,inactive',
        ]);

        Country::create([
            'country_name' => $request->country_name,
            'country_code' => $request->country_code,
            'status'       => $request->status,
        ]);

        return redirect()
            ->route('countries.index')
            ->with('success', 'Country added successfully');
    }

    /**
     * Show the form for editing the specified country.
     */
    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified country in database.
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'country_name' => 'required|string|max:255',
            'country_code' => 'nullable|string|max:10',
            'status'       => 'required|in:active,inactive',
        ]);

        $country->update([
            'country_name' => $request->country_name,
            'country_code' => $request->country_code,
            'status'       => $request->status,
        ]);

        return redirect()
            ->route('countries.index')
            ->with('success', 'Country updated successfully');
    }

    /**
     * Remove the specified country from database.
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()
            ->route('countries.index')
            ->with('success', 'Country deleted successfully');
    }
}
