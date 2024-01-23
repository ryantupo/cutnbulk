<?php


namespace App\Http\Controllers;

use App\Models\WeightEntry;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        // $weightEntries = $user->weightEntries()->orderBy('date')->get();

        $weightEntries = WeightEntry::all();

        return view('dashboard', ['weightEntries' => $weightEntries]);
    }
}
