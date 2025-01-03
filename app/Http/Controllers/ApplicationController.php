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
        // Ensure only candidates can apply
        if (Auth::user()->role !== 'candidat') {
            return redirect()->back()->with('error', 'Seuls les candidats peuvent postuler aux offres d\'emploi.');
        }

        try {
            $jobOffer = JobOffer::findOrFail($jobOfferId);

            // Check if the user has already applied
            $existingApplication = Application::where('user_id', Auth::id())
                ->where('job_offer_id', $jobOfferId)
                ->first();

            if ($existingApplication) {
                return redirect()->back()->with('error', 'Vous avez déjà postulé à cette offre d\'emploi.');
            }

            // Create the application with initial pending status
            Application::create([
                'user_id' => Auth::id(),
                'job_offer_id' => $jobOfferId,
                'status' => 'pending'
            ]);

            return redirect()->route('jobs.index')
                ->with('success', 'Votre candidature a été soumise avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la soumission de votre candidature.');
        }
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