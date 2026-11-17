<?php

namespace App\Http\Controllers;

use App\Models\Senior;
use Illuminate\Http\Request;

class SeniorController extends Controller
{
    public function index()
    {
        $seniors = Senior::latest()->get();
        return view('seniors.index', compact('seniors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'osca_id'        => 'required|string|unique:seniors,osca_id',
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'birthdate'      => 'required|date',
            'contact_number' => 'nullable|string',
            'barangay'       => 'required|string',
        ], [
            'osca_id.unique'   => 'Warning: This OSCA ID number is already registered in the system!',
            'osca_id.required' => 'Please provide an OSCA ID number.',
            'birthdate.required' => 'Please select a valid birthdate.',
        ]);

        Senior::create($validated);

        return redirect()->route('seniors.index')->with('success', 'Senior Citizen successfully registered!');
    }
}