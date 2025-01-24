<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;  // Your application model
use App\Models\JobOffer;     // Your job offer model

class CandidateController extends Controller
{
    public function myApplications()
    {
        $user = Auth::user();  // Get the authenticated user
        $applications = Application::where('user_id', $user->id)
            ->with('jobOffer')  
            ->get();

        return view('candidate.my-applications', compact('applications'));
    }
}
