<?php

namespace App\Http\Controllers;

use App\Models\WeightEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    public function save(Request $request)
    {
        // Validate the request
        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Save the data to the database with the user_id
        WeightEntry::create([
            'user_id' => $userId,
            'date' => $request->input('date'),
            'weight' => $request->input('weight'),
            // Add other fields as needed
        ]);

        // Redirect back or return a response as needed
        return redirect()->back()->with('success', 'Weight log added successfully');
    }
}
