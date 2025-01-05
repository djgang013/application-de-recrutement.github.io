<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function apply(Request $request, $jobOfferId)
    {
        if (Auth::user()->role !== 'candidat') {
            return redirect()->back()->with('error', 'Seuls les candidats peuvent postuler.');
        }
    
        // Fetch the job offer to ensure it exists and use it in the check
        $jobOffer = JobOffer::find($jobOfferId);
    
        if (!$jobOffer) {
            return redirect()->back()->with('error', 'Cette offre d\'emploi n\'existe pas.');
        }
    
        // Check if the candidate has already applied for this job
        $existingApplication = Application::where('user_id', Auth::id())
                                          ->where('job_offer_id', $jobOfferId)
                                          ->first();
    
        if ($existingApplication) {
            return redirect()->back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }
    
        // Validate the request
        $request->validate([
            'cover_letter' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);
    
        // Store the cover letter if provided
        $coverLetterPath = null;
        if ($request->hasFile('cover_letter')) {
            $coverLetterPath = $request->file('cover_letter')->store('cover_letters', 'public');
        }
    
        // Create the new application
        Application::create([
            'user_id' => Auth::id(),
            'job_offer_id' => $jobOfferId,
            'status' => 'pending',
            'cv_path' => Auth::user()->cv_path,  // Link existing CV
            'cover_letter_path' => $coverLetterPath,
        ]);
    
        return redirect()->route('jobs.index')->with('success', 'Candidature soumise avec succès!');
    }
    

    public function index()
{
    $applications = Application::with(['jobOffer', 'user'])
        ->whereHas('jobOffer', function ($query) {
            $query->where('recruiter_id', auth()->id());
        })
        ->get();

    return view('applications.index', compact('applications'));
}



public function updateStatus(Request $request, Application $application)
{
    $this->authorize('update', $application); // Optional, for authorization

    $application->update(['status' => $request->status]);

    return redirect()->route('applications.index')->with('success', 'Application status updated successfully.');
}
}