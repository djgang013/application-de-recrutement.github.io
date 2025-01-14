@extends('layouts.app')
<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
}

.applications-container {
    max-width: 1400px;
    margin: 2rem auto;
    padding: 0 2rem;
}

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--gray-200);
}

.page-title {
    font-size: 1.875rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.625rem 1rem;
    font-size: 0.875rem;
    color: var(--gray-600);
    background-color: white;
    border: 1px solid var(--gray-200);
    border-radius: 0.5rem;
    text-decoration: none;
    transition: all 0.2s ease;
}

.back-button:hover {
    background-color: var(--gray-50);
    border-color: var(--gray-300);
    transform: translateX(-2px);
}

.applications-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 1.5rem;
}

.application-card {
    background: white;
    border: 1px solid var(--gray-200);
    border-radius: 0.75rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.application-card:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transform: translateY(-2px);
}

.card-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card-content {
    padding: 1.5rem;
}

.job-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 1rem;
}

.job-description {
    color: var(--gray-600);
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: 1.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.meta-info {
    padding: 1rem;
    background-color: var(--gray-50);
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
}

.meta-info p {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.meta-info p:last-child {
    margin-bottom: 0;
}

.meta-info strong {
    color: var(--gray-700);
}

.card-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
}

.action-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.primary-button {
    background-color: var(--primary);
    color: white;
}

.primary-button:hover {
    background-color: var(--primary-dark);
}

.secondary-button {
    background-color: white;
    color: var(--primary);
    border: 1px solid var(--primary);
}

.secondary-button:hover {
    background-color: var(--gray-50);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 0.75rem;
    border: 1px solid var(--gray-200);
}

.empty-state-message {
    color: var(--gray-600);
    font-size: 1.125rem;
    margin-bottom: 1.5rem;
}

.error-card {
    background-color: #fee2e2;
    border: 1px solid #fecaca;
    padding: 1rem;
    border-radius: 0.5rem;
    text-align: center;
    color: #dc2626;
}

.dismiss-button {
    background: transparent;
    border: none;
    color: #dc2626;
    font-size: 0.875rem;
    cursor: pointer;
}

.dismiss-button:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .applications-container {
        padding: 1rem;
    }
    
    .applications-grid {
        grid-template-columns: 1fr;
    }
    
    .page-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .card-actions {
        grid-template-columns: 1fr;
    }
}
</style>

@section('content')
<div class="applications-container">
    <div class="page-header">
        <h1 class="page-title">Your Job Applications</h1>
        <a href="{{ route('jobs.index') }}" class="back-button">
            ← Return to Job Listings
        </a>
    </div>

    @if ($applications->isEmpty())
        <div class="empty-state">
            <p class="empty-state-message">You haven't submitted any job applications yet.</p>
            <a href="{{ route('jobs.index') }}" class="action-button primary-button">Browse Available Positions</a>
        </div>
    @else
        <div class="applications-grid">
            @foreach ($applications as $application)
                @if ($application->jobOffer)
                    <div class="application-card" data-application-id="{{ $application->id }}">
                        @if ($application->jobOffer->image)
                            <img src="{{ asset('storage/' . $application->jobOffer->image) }}" 
                                 alt="{{ $application->jobOffer->title }}" 
                                 class="card-image">
                        @endif

                        <div class="card-content">
                            <h3 class="job-title">{{ $application->jobOffer->title }}</h3>
                            <p class="job-description">{{ $application->jobOffer->description }}</p>

                            <div class="meta-info">
                                <p>
                                    <strong>Application Date:</strong> 
                                    {{ $application->created_at->format('F d, Y') }}
                                </p>
                                <p>
                                    <strong>Company:</strong>
                                    {{ $application->jobOffer->company }}
                                </p>
                            </div>

                            <div class="card-actions">
                                @if ($application->cv_path)
                                    <a href="{{ asset('storage/' . $application->cv_path) }}" 
                                       target="_blank" 
                                       class="action-button secondary-button">
                                        View CV
                                    </a>
                                @endif

                                @if ($application->cover_letter_path)
                                    <a href="{{ asset('storage/' . $application->cover_letter_path) }}" 
                                       target="_blank" 
                                       class="action-button secondary-button">
                                        View Cover Letter
                                    </a>
                                @endif

                                <a href="{{ route('applications.edit', $application->id) }}" 
                                   class="action-button primary-button">
                                    Edit Application
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="application-card" data-application-id="{{ $application->id }}">
                        <div class="card-content">
                            <div class="error-card">
                                ⚠️ This job posting is no longer available.
                                <button class="dismiss-button" onclick="dismissApplication('{{ $application->id }}')">Dismiss</button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>

<script>
    function dismissApplication(applicationId) {
        const dismissedApplications = JSON.parse(localStorage.getItem('dismissedApplications')) || [];
        if (!dismissedApplications.includes(applicationId)) {
            dismissedApplications.push(applicationId);
            localStorage.setItem('dismissedApplications', JSON.stringify(dismissedApplications));
        }
        document.querySelector(`[data-application-id="${applicationId}"]`).style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const dismissedApplications = JSON.parse(localStorage.getItem('dismissedApplications')) || [];
        dismissedApplications.forEach(id => {
            const element = document.querySelector(`[data-application-id="${id}"]`);
            if (element) {
                element.style.display = 'none';
            }
        });
    });
</script
