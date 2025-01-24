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
    
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'company' => 'required|string',
        'salary' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000', 
    ]);

    
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('job_images', 'public'); 
        
    }

    // Create a new job offer and assign the current user's ID to the job offer
    JobOffer::create([
        'recruiter_id' => auth()->id(),
        'title' => $validated['title'],
        'description' => $validated['description'],
        'location' => $validated['location'],
        'company' => $validated['company'],
        'salary' => $validated['salary'],
        'image' => $imagePath,
        'user_id' => auth()->id(), // Add the logged-in user's ID
    ]);

    return redirect()->route('job-offers.index')->with('success', 'Offre d\'emploi ajoutée avec succès!');
}


public function index()

{

    $jobOffers = JobOffer::all();

   
    return view('job_offers.index', compact('jobOffers'));
    
    $jobOffers = JobOffer::where('user_id', Auth::id())->get();

    return view('job_offers.index', compact('jobOffers'));
}
public function destroy(JobOffer $jobOffer)
{
    
    if (Auth::id() !== $jobOffer->user_id) {
        abort(403, 'Unauthorized action.');
    }

    
    $jobOffer->delete();

    
    return redirect()->route('job-offers.index')->with('success', 'Offre d\'emploi supprimée avec succès!');
}
public function edit($id)
{
    
    $jobOffer = JobOffer::findOrFail($id);

    
    return view('job_offers.edit', compact('jobOffer'));
}

public function update(Request $request, $id)
{
    
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'company' => 'required|string',
        'salary' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000', 
    ]);

    
    $jobOffer = JobOffer::findOrFail($id);

    
    $jobOffer->title = $validated['title'];
    $jobOffer->description = $validated['description'];
    $jobOffer->location = $validated['location'];
    $jobOffer->company = $validated['company'];
    $jobOffer->salary = $validated['salary'];

    
    if ($request->hasFile('image')) {
       
        if ($jobOffer->image) {
            Storage::disk('public')->delete($jobOffer->image);
        }

        
        $jobOffer->image = $request->file('image')->store('job_images', 'public');
    }

   
    $jobOffer->save();

    
    return redirect()->route('job-offers.index')->with('success', 'Offre d\'emploi mise à jour avec succès!');
}
public function show(JobOffer $jobOffer)
{
    return view('job_offers.show', compact('jobOffer'));
}


}
