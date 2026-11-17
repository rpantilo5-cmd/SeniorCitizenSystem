<?php

namespace App\Http\Controllers;

use App\Models\BenefitRelease;
use App\Models\Senior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BenefitReleaseController extends Controller
{
    public function create()
    {
        $seniors = Senior::all();
        return view('benefits.create', compact('seniors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'senior_id' => 'required|exists:seniors,id',
            'program_name' => 'required|string',
            'benefit_type' => 'required',
            'amount_or_details' => 'required|string',
        ]);

        $alreadyReceived = BenefitRelease::where('senior_id', $request->senior_id)
            ->where('program_name', $request->program_name)
            ->exists();

        if ($alreadyReceived) {
            return redirect()->back()->with('error', 'ALERT: Kini nga Senior Citizen nakadawat na og benepisyo sa kaining maong Program/Batch!');
        }

        BenefitRelease::create([
            'senior_id' => $request->senior_id,
            'program_name' => $request->program_name,
            'benefit_type' => $request->benefit_type,
            'amount_or_details' => $request->amount_or_details,
            'date_released' => now(),
            'released_by' => Auth::id(),
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('dashboard')->with('success', 'Benefit Release Logged Successfully!');
    }
}