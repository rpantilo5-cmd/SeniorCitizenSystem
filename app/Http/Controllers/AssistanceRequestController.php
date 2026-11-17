<?php

namespace App\Http\Controllers;

use App\Models\AssistanceRequest;
use App\Models\Senior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssistanceRequestController extends Controller
{
    public function create()
    {
        $seniors = Senior::all();
        return view('requests.create', compact('seniors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'senior_id' => 'required|exists:seniors,id',
            'request_type' => 'required',
            'description' => 'nullable|string',
        ]);

        AssistanceRequest::create([
            'senior_id' => $request->senior_id,
            'request_type' => $request->request_type,
            'description' => $request->description,
            'status' => 'Pending',
            'processed_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Assistance Request Submitted Successfully!');
    }
}