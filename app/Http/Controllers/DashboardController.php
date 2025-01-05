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
            return view('dashboard.candidat', compact('user'));
        }

        if ($user->role == 'recruteur') {
            // Show the dashboard for the recruteur
            return redirect()->route('job-offers.index');
        }

        // Default case if role doesn't match (optional)
        return redirect()->route('login');
    }
}
