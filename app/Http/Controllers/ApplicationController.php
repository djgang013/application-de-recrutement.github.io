<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;

use App\Models\JobOffer;
use App\Models\Application;
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
        
        $jobOffer = JobOffer::find($jobOfferId);
        if (!$jobOffer) {
            return redirect()->back()->with('error', 'Cette offre d\'emploi n\'existe pas.');
        }
    
        $existingApplication = Application::where('user_id', Auth::id())
                                          ->where('job_offer_id', $jobOfferId)
                                          ->first();
    
        if ($existingApplication) {
            return redirect()->back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }
    
        $request->validate([
            'cover_letter' => 'nullable|mimes:pdf,doc,docx|max:2048',  // Optional
            'cv' => 'nullable|mimes:pdf|max:2048',  // Optional
        ]);
    
        // Store the cover letter if provided
        $coverLetterPath = null;
        if ($request->hasFile('cover_letter')) {
            $coverLetterPath = $request->file('cover_letter')->store('cover_letters', 'public');
        }
    
        // Store the CV if provided
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }
    
        // Create the new application
        Application::create([
            'user_id' => Auth::id(),
            'job_offer_id' => $jobOfferId,
            'status' => 'pending',
            'cv_path' => $cvPath,  // Store CV path
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

public function edit(Application $application)
{
   
    return view('applications.edit', compact('application')); // Pass the variable
}

public function update(Request $request, Application $application)
{
   

    $request->validate([
        'cv' => 'nullable|mimes:pdf|max:2048',
        'cover_letter' => 'nullable|mimes:pdf|max:2048',
    ]);

    // Handle deleting the CV
    if ($request->has('delete_cv') && $request->delete_cv == 1 && $application->cv_path) {
        // Delete the file from storage
        Storage::disk('public')->delete($application->cv_path);
        // Remove the CV path from the database
        $application->cv_path = null;
    }

    // Handle deleting the Cover Letter
    if ($request->has('delete_cover_letter') && $request->delete_cover_letter == 1 && $application->cover_letter_path) {
        // Delete the file from storage
        Storage::disk('public')->delete($application->cover_letter_path);
        // Remove the cover letter path from the database
        $application->cover_letter_path = null;
    }

    // Handle uploading a new CV
    if ($request->hasFile('cv')) {
        $cvPath = $request->file('cv')->store('cvs', 'public');
        $application->cv_path = $cvPath;
    }

    // Handle uploading a new Cover Letter
    if ($request->hasFile('cover_letter')) {
        $coverLetterPath = $request->file('cover_letter')->store('cover_letters', 'public');
        $application->cover_letter_path = $coverLetterPath;
    }

    // Save the application
    $application->save();

    return redirect()->route('candidate.applications')->with('success', 'Application updated successfully.');
}
}