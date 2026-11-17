<?php

namespace App\Http\Controllers;

use App\Models\AssistanceRequest;
use App\Models\Senior;
use Illuminate\Http\Request;

class AssistanceController extends Controller
{
    public function index()
    {
        $requests = AssistanceRequest::with('senior')->latest()->get();
        $seniors = Senior::orderBy('last_name')->get();

        return view('assistance.index', compact('requests', 'seniors'));
    }

    public function store(Request $request)
    {
        // 1. Basic Validation
        $request->validate([
            'senior_id'    => 'required|exists:seniors,id',
            'request_type' => 'required|string|max:255',
            'details'      => 'nullable|string',
        ], [
            'senior_id.required'    => 'Please select a senior citizen.',
            'request_type.required' => 'Please select a request type.',
        ]);

        // 2. Prevent Duplicate Pending Request for the Same Senior and Request Type
        $exists = AssistanceRequest::where('senior_id', $request->senior_id)
            ->where('request_type', $request->request_type)
            ->where('status', 'Pending')
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['duplicate' => 'Warning: This senior citizen ALREADY has a pending request for (' . $request->request_type . ')! Duplicate request prevented.']);
        }

        // 3. Save if valid
        AssistanceRequest::create([
            'senior_id'    => $request->senior_id,
            'request_type' => $request->request_type,
            'details'      => $request->details,
            'status'       => 'Pending',
        ]);

        return redirect()->route('assistance.index')->with('success', 'Assistance Request submitted successfully!');
    }
}