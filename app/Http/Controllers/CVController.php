<?php

namespace App\Http\Controllers;

use App\Models\CV;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CVController extends Controller
{
    public function index() {
        $cvs = Auth::user()->cvs;
        return view('cvs.index', compact('cvs'));
    }

    public function create() {
        return view('cvs.create');
    }

    public function store(Request $request)
    {
        // Validate the CV file
        $request->validate([
            'cv' => 'required|mimes:pdf|max:10240', // Max size 10MB, only PDF
        ]);

        // Store the file in the 'cvs' folder inside 'public' disk
        $cvPath = $request->file('cv')->store('cvs', 'public');

        // Get the authenticated user
        $user = auth()->user();

        // Save the CV path in the user's profile (if you want to associate the CV with the user)
        $user->cv_path = $cvPath;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'CV ajouté avec succès!');
    }

    // Add a method to download the CV
    public function download(User $user)
    {
        // Get the path of the user's CV
        $cvPath = storage_path('app/public/' . $user->cv_path);

        // Check if the CV file exists
        if (file_exists($cvPath)) {
            return response()->download($cvPath);
        }

        return redirect()->route('dashboard')->with('error', 'CV non trouvé.');
    }
    public function edit(CV $cv) {
        return view('cvs.edit', compact('cv'));
    }

    public function update(Request $request, CV $cv) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file_path' => 'nullable|file',
        ]);

        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('cvs');
            $validated['file_path'] = $filePath;
        }

        $cv->update($validated);
        return redirect()->route('cvs.index');
    }

    public function destroy(CV $cv) {
        $cv->delete();
        return redirect()->route('cvs.index');
    }
}
