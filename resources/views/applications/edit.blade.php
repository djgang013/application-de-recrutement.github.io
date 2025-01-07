@extends('layouts.app')
<style>
    .content {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
}

h1 {
    color: #2c3e50;
    margin-bottom: 2rem;
    font-size: 2rem;
}

form {
    background: #ffffff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

form > div {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #eee;
}

form > div:last-child {
    border-bottom: none;
}

label {
    display: block;
    margin-bottom: 0.75rem;
    color: #4a4a4a;
    font-weight: 500;
}

input[type="file"] {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    margin-top: 0.5rem;
}

a {
    display: inline-block;
    color: #1a73e8;
    text-decoration: none;
    padding: 0.5rem 1rem;
    background: #f8f9fa;
    border-radius: 4px;
    margin: 0.5rem 0;
}

a:hover {
    background: #e9ecef;
    color: #1557b0;
}

.checkbox-wrapper {
    margin-top: 1rem;
}

input[type="checkbox"] {
    margin-right: 0.5rem;
}

button[type="submit"] {
    background: #28a745;
    color: white;
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.2s ease;
}

button[type="submit"]:hover {
    background: #218838;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

p {
    color: #666;
    font-style: italic;
    margin: 0.5rem 0;
}

@media (max-width: 768px) {
    .content {
        padding: 1rem;
    }
    
    form {
        padding: 1rem;
    }
}
</style>
@section('content')
    <h1>Edit Application</h1>

    <form action="{{ route('applications.update', $application->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Current CV:</label>
            @if ($application->cv_path)
                <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank">Download CV</a>
                <div>
                    <label>
                        <input type="checkbox" name="delete_cv" value="1"> Delete current CV
                    </label>
                </div>
            @else
                <p>No CV uploaded.</p>
            @endif
        </div>

        <div>
            <label for="cv">Upload New CV (Optional):</label>
            <input type="file" name="cv" id="cv" accept=".pdf">
        </div>

        <div>
            <label>Current Cover Letter:</label>
            @if ($application->cover_letter_path)
                <a href="{{ asset('storage/' . $application->cover_letter_path) }}" target="_blank">Download Cover Letter</a>
                <div>
                    <label>
                        <input type="checkbox" name="delete_cover_letter" value="1"> Delete current Cover Letter
                    </label>
                </div>
            @else
                <p>No cover letter uploaded.</p>
            @endif
        </div>

        <div>
            <label for="cover_letter">Upload New Cover Letter (Optional):</label>
            <input type="file" name="cover_letter" id="cover_letter" accept=".pdf">
        </div>

        <button type="submit">Update Application</button>
        <a href="{{ route('jobs.index') }}">retour au page d'acceuill</a>
    </form>
@endsection
