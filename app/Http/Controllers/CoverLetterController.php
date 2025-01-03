<?php

namespace App\Http\Controllers;

use App\Models\CoverLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoverLetterController extends Controller
{
    public function index() {
        $letters = Auth::user()->coverLetters;
        return view('cover_letters.index', compact('letters'));
    }

    public function create() {
        return view('cover_letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx', // Add file validation
        ]);
    
        // Upload the file
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('cover_letters');
            $validated['file_path'] = $filePath;
        }
    
        // Create the cover letter
        $coverLetter = new CoverLetter($validated);
        $coverLetter->user_id = auth()->id();  // Assuming a user is logged in
        $coverLetter->save();
    
        return redirect()->route('cover-letters.index')->with('success', 'Lettre de motivation ajoutée avec succès!');
    }
    
    public function update(Request $request, CoverLetter $coverLetter)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx', // Optional file validation
        ]);
    
        // Check if the user wants to remove the existing file
        if ($request->has('remove_file') && $coverLetter->file_path) {
            Storage::delete($coverLetter->file_path);  // Delete the old file if checkbox is checked
            $validated['file_path'] = null;  // Remove the file path
        }
    
        // Handle the file upload if a new file is provided
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('cover_letters');
            $validated['file_path'] = $filePath;
        }

        // Only update file_path if it's provided or removed
        if (is_null($validated['file_path']) && !$request->hasFile('file_path')) {
            unset($validated['file_path']);
        }
    
        // Update the cover letter with the validated data
        $coverLetter->update($validated);
    
        return redirect()->route('cover-letters.index')->with('success', 'Lettre de motivation mise à jour avec succès!');
    }
    
    public function edit(CoverLetter $coverLetter) {
        return view('cover_letters.edit', compact('coverLetter'));
    }

    public function destroy(CoverLetter $coverLetter) {
        $coverLetter->delete();
        return redirect()->route('cover-letters.index');
    }

    public function download(CoverLetter $coverLetter)
    {
        // Check if the file exists and belongs to the current user
        if ($coverLetter->user_id !== auth()->id()) {
            return redirect()->route('cover-letters.index')->with('error', 'Unauthorized access.');
        }
    
        // Check if the file exists in storage
        if ($coverLetter->file_path && Storage::exists($coverLetter->file_path)) {
            return Storage::download($coverLetter->file_path);
        }
    
        return redirect()->route('cover-letters.index')->with('error', 'File not found.');
    }
}
