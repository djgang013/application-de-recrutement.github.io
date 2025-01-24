<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        // Check user role and redirect or display specific data accordingly
        if ($user->role == 'candidat') {
            // Show the dashboard for the candidate
          
            $jobOffers = \App\Models\JobOffer::all();  // Adjust query based on your logic
        
        return view('job_offers.index', compact('user', 'jobOffers'));
        }

        if ($user->role == 'recruteur') {
            // Show the dashboard for the recruteur
            return redirect()->route('job-offers.index');
        }

        // Default case if role doesn't match 
        return redirect()->route('login');
    }
}
