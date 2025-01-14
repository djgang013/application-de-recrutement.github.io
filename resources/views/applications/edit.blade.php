@extends('layouts.app')

<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --success: #059669;
    --success-dark: #047857;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
}

.application-edit {
    max-width: 800px;
    margin: 3rem auto;
    padding: 0 1.5rem;
}

.page-header {
    margin-bottom: 2rem;
}

.page-title {
    color: var(--gray-800);
    font-size: 1.875rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    color: var(--gray-600);
    font-size: 1rem;
}

.edit-form {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    padding: 2rem;
}

.form-section {
    padding: 1.5rem;
    background: var(--gray-50);
    border-radius: 0.75rem;
    margin-bottom: 2rem;
}

.form-section:last-child {
    margin-bottom: 0;
}

.section-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--gray-200);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-label {
    display: block;
    color: var(--gray-700);
    font-size: 0.938rem;
    font-weight: 500;
    margin-bottom: 0.75rem;
}

.file-input {
    width: 100%;
    padding: 2rem;
    border: 2px dashed var(--gray-300);
    border-radius: 0.75rem;
    background: white;
    transition: all 0.2s ease;
    cursor: pointer;
}

.file-input:hover {
    border-color: var(--primary);
}

.document-link {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.25rem;
    background: white;
    border: 1px solid var(--gray-200);
    border-radius: 0.5rem;
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
    margin: 0.5rem 0;
}

.document-link:hover {
    background: var(--gray-50);
    border-color: var(--primary);
}

.checkbox-group {
    margin-top: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.checkbox-label {
    color: var(--gray-600);
    font-size: 0.875rem;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-primary {
    background: var(--success);
    color: white;
    border: none;
}

.btn-primary:hover {
    background: var(--success-dark);
}

.btn-secondary {
    background: white;
    color: var(--gray-700);
    border: 1px solid var(--gray-200);
}

.btn-secondary:hover {
    background: var(--gray-50);
    border-color: var(--gray-300);
}

.empty-state {
    color: var(--gray-600);
    font-style: italic;
    margin: 0.5rem 0;
}

@media (max-width: 768px) {
    .application-edit {
        margin: 2rem auto;
    }
    
    .edit-form {
        padding: 1.5rem;
    }
    
    .form-section {
        padding: 1.25rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
}
</style>

@section('content')
<div class="application-edit">
    <div class="page-header">
        <h1 class="page-title">Edit Application</h1>
        <p class="page-subtitle">Update your application documents</p>
    </div>

    <form class="edit-form" action="{{ route('applications.update', $application->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h2 class="section-title">Curriculum Vitae (CV)</h2>
            
            <div class="form-group">
                <label class="form-label">Current CV</label>
                @if ($application->cv_path)
                    <div>
                        <a href="{{ asset('storage/' . $application->cv_path) }}" class="document-link" target="_blank">
                            View Current CV
                        </a>
                        <div class="checkbox-group">
                            <input type="checkbox" name="delete_cv" id="delete_cv" value="1">
                            <label class="checkbox-label" for="delete_cv">Remove current CV</label>
                        </div>
                    </div>
                @else
                    <p class="empty-state">No CV currently uploaded</p>
                @endif
            </div>

            <div class="form-group">
                <label class="form-label" for="cv">Upload New CV</label>
                <input type="file" name="cv" id="cv" class="file-input" accept=".pdf">
            </div>
        </div>

        <div class="form-section">
            <h2 class="section-title">Cover Letter</h2>
            
            <div class="form-group">
                <label class="form-label">Current Cover Letter</label>
                @if ($application->cover_letter_path)
                    <div>
                        <a href="{{ asset('storage/' . $application->cover_letter_path) }}" class="document-link" target="_blank">
                            View Current Cover Letter
                        </a>
                        <div class="checkbox-group">
                            <input type="checkbox" name="delete_cover_letter" id="delete_cover_letter" value="1">
                            <label class="checkbox-label" for="delete_cover_letter">Remove current cover letter</label>
                        </div>
                    </div>
                @else
                    <p class="empty-state">No cover letter currently uploaded</p>
                @endif
            </div>

            <div class="form-group">
                <label class="form-label" for="cover_letter">Upload New Cover Letter</label>
                <input type="file" name="cover_letter" id="cover_letter" class="file-input" accept=".pdf">
            </div>
        </div>

        <div class="action-buttons">
            <button type="submit" class="btn btn-primary">Update Application</button>
            <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Return to Dashboard</a>
        </div>
    </form>
</div>
@endsection