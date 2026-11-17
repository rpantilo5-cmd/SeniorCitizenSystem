<?php

namespace App\Http\Controllers;

use App\Models\BenefitRelease;
use App\Models\Senior;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        $benefits = BenefitRelease::with('senior')->latest()->get();
        $seniors = Senior::orderBy('last_name')->get();

        return view('benefits.index', compact('benefits', 'seniors'));
    }

    public function store(Request $request)
    {
        // 1. Basic validation
        $request->validate([
            'senior_id'    => 'required|exists:seniors,id',
            'benefit_type' => 'required|string|max:255',
            'amount'       => 'required|numeric|min:0',
            'release_date' => 'required|date',
        ], [
            'senior_id.required'    => 'Please select a senior citizen.',
            'benefit_type.required' => 'Please specify the benefit type.',
            'amount.required'       => 'Please enter a valid amount.',
            'release_date.required' => 'Please select the release date.',
        ]);

        // 2. Prevent duplicate release for the same senior, benefit type, and date
        $exists = BenefitRelease::where('senior_id', $request->senior_id)
            ->where('benefit_type', $request->benefit_type)
            ->where('release_date', $request->release_date)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['duplicate' => 'Warning: This senior citizen has ALREADY received this benefit (' . $request->benefit_type . ') on the selected date! Duplicate entry prevented.']);
        }

        // 3. Save if valid and unique
        BenefitRelease::create([
            'senior_id'    => $request->senior_id,
            'benefit_type' => $request->benefit_type,
            'amount'       => $request->amount,
            'release_date' => $request->release_date,
        ]);

        return redirect()->route('benefits.index')->with('success', 'Benefit Release logged successfully!');
    }
}