@extends('layouts.app')
<style>
.content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    background: #f8fafc;
    min-height: 100vh;
}

.back-link {
    display: inline-flex;
    align-items: center;
    color: #475569;
    text-decoration: none;
    margin-bottom: 2rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    background: white;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.back-link:hover {
    background: #f1f5f9;
    transform: translateX(-5px);
}

h1 {
    color: #0f172a;
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-align: center;
    position: relative;
}

h1::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: #4f46e5;
    border-radius: 2px;
}

.empty-state {
    background: white;
    padding: 3rem;
    border-radius: 1rem;
    text-align: center;
    color: #64748b;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
}

.applications-grid {
    display: grid;
    gap: 2rem;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
}

.application-card {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    cursor: pointer;
}

.application-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
}

.job-title {
    color: #1e293b;
    font-size: 1.25rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.description {
    color: #475569;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.meta {
    background: #f8fafc;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
}

.meta strong {
    color: #0f172a;
}

.meta p {
    margin-bottom: 0.5rem;
}

.document-link {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.25rem;
    background: #4f46e5;
    color: white;
    border-radius: 0.5rem;
    text-decoration: none;
    margin-right: 0.75rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.document-link:hover {
    background: #4338ca;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
}

.edit-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 80%;
    padding: 0.75rem 1.5rem;
    background: #4f46e5;
    color: white;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
}

.edit-button:hover {
    background: #4338ca;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
}

.unavailable {
    background: #fef2f2;
    color: #dc2626;
    padding: 1rem;
    border-radius: 0.5rem;
    text-align: center;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.application-card {
    animation: fadeIn 0.5s ease-out forwards;
    animation-delay: calc(var(--index) * 0.1s);
}

@media (max-width: 768px) {
    .content { padding: 1rem; }
    .applications-grid { grid-template-columns: 1fr; }
    h1 { font-size: 2rem; }
    .document-link { width: 100%; justify-content: center; margin: 0 0 0.5rem 0; }
}
</style>
@section('content')
<div class="content">
    <a href="{{ route('jobs.index') }}" class="back-link">← Return to Home</a>
    <h1>Your Job Applications</h1>

    @if ($applications->isEmpty())
        <div class="empty-state">You have not applied for any jobs yet.</div>
    @else
        <div class="applications-grid">
            @foreach ($applications as $application)
                @if ($application->jobOffer)
                    <div class="application-card" style="--index: {{ $loop->index }}">
                        <h3 class="job-title">{{ $application->jobOffer->title }}</h3>
                        <h3 class="job-image">{{ asset('storage/' . $application->image) }}</h3>
                        <p class="description">{{ $application->jobOffer->description }}</p>
                        <div class="meta">
                            <p><strong>Applied on:</strong> {{ $application->created_at->format('d M Y') }}</p>
                            @if ($application->cv_path)
                                <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank" class="document-link">View CV</a>
                            @endif
                            @if ($application->cover_letter_path)
                                <a href="{{ asset('storage/' . $application->cover_letter_path) }}" target="_blank" class="document-link">View Cover Letter</a>
                            @endif
                        </div>
                        <a href="{{ route('applications.edit', $application->id) }}" class="edit-button">Edit Application</a>
                    </div>
                @else
                    <div class="application-card" style="--index: {{ $loop->index }}">
                        <div class="unavailable">⚠️ This job offer is no longer available.</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection