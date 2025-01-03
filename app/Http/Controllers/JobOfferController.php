<?php

// app/Http/Controllers/JobOfferController.php
namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobOfferController extends Controller
{
    public function create()
    {
        return view('job_offers.create');
    }

  
    public function store(Request $request)
{
    // Validate the input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'company' => 'required|string',
        'salary' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000', // Add image validation
    ]);

    // Handle the image upload if present
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('job_images', 'public'); // Store the image in storage/app/public/job_images
        
    }

    // Create a new job offer and assign the current user's ID to the job offer
    JobOffer::create([
        'recruiter_id' => auth()->id(),
        'title' => $validated['title'],
        'description' => $validated['description'],
        'location' => $validated['location'],
        'company' => $validated['company'],
        'salary' => $validated['salary'],
        'image' => $imagePath, // Save the image path
        'user_id' => auth()->id(), // Add the logged-in user's ID
    ]);

    return redirect()->route('job-offers.index')->with('success', 'Offre d\'emploi ajoutée avec succès!');
}


public function index()

{

    $jobOffers = JobOffer::all();

    // Return the view with the job offers
    return view('job_offers.index', compact('jobOffers'));
    // Get the job offers for the logged-in recruteur
    $jobOffers = JobOffer::where('user_id', Auth::id())->get();

    return view('job_offers.index', compact('jobOffers'));
}
public function destroy(JobOffer $jobOffer)
{
    // Check if the logged-in user is the owner of the job offer
    if (Auth::id() !== $jobOffer->user_id) {
        abort(403, 'Unauthorized action.');
    }

    // Delete the job offer
    $jobOffer->delete();

    // Redirect back to the job offers index page with a success message
    return redirect()->route('job-offers.index')->with('success', 'Offre d\'emploi supprimée avec succès!');
}
public function edit($id)
{
    // Find the job offer by ID
    $jobOffer = JobOffer::findOrFail($id);

    // Return the view with the job offer data
    return view('job_offers.edit', compact('jobOffer'));
}

public function update(Request $request, $id)
{
    // Validate the incoming data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'company' => 'required|string',
        'salary' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000', // Optional image validation
    ]);

    // Find the job offer by ID
    $jobOffer = JobOffer::findOrFail($id);

    // Update the job offer details
    $jobOffer->title = $validated['title'];
    $jobOffer->description = $validated['description'];
    $jobOffer->location = $validated['location'];
    $jobOffer->company = $validated['company'];
    $jobOffer->salary = $validated['salary'];

    // Handle the image upload if a new one is provided
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($jobOffer->image) {
            Storage::disk('public')->delete($jobOffer->image);
        }

        // Store the new image
        $jobOffer->image = $request->file('image')->store('job_images', 'public');
    }

    // Save the updated job offer
    $jobOffer->save();

    // Redirect back to the job offers index with success message
    return redirect()->route('job-offers.index')->with('success', 'Offre d\'emploi mise à jour avec succès!');
}


}
