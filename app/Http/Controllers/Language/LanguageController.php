<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    // List all languages
    public function index()
    {
        $languages = Language::latest()->paginate(10);
        return view('languages.index', compact('languages'));
    }

    // Show form to create a language
    public function create()
    {
        return view('languages.create');
    }

    // Store a new language
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:languages,name|max:255',
            'code' => 'required|unique:languages,code|max:10',
        ]);

        Language::create($request->all());
        return redirect()->route('languages.index')->with('success', 'Language added successfully!');
    }

    // Show form to edit a language
    public function edit(Language $language)
    {
        return view('languages.edit', compact('language'));
    }

    // Update a language
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'required|unique:languages,name,' . $language->id . '|max:255',
            'code' => 'required|unique:languages,code,' . $language->id . '|max:10',
        ]);

        $language->update($request->all());
        return redirect()->route('languages.index')->with('success', 'Language updated successfully!');
    }

    // Delete a language
    public function destroy(Language $language)
    {
        $language->delete();
        return redirect()->route('languages.index')->with('success', 'Language deleted successfully!');
    }
}
