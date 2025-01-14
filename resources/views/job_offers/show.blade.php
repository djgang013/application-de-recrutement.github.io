@extends('layouts.app') <!-- Adjust layout if different -->
<style>
    main.main-content {
        max-width: 1000px;
        margin: 4rem auto;
        padding: 2rem;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-title {
        font-size: 2.5rem;
        color: #1a365d;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }

    .job-meta p {
        font-size: 1.125rem;
        margin-bottom: 1rem;
        color: #4a5568;
    }

    .job-meta p strong {
        color: #2b6cb0;
        font-weight: 600;
    }

    img {
        max-width: 100%;
        height: auto;
        margin-top: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .button {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button-secondary {
        background-color: #4299e1;
        color: white;
    }

    .button-secondary:hover {
        background-color: #2b6cb0;
    }

    .button-outline {
        background-color: transparent;
        border: 2px solid #2b6cb0;
        color: #2b6cb0;
    }

    .button-outline:hover {
        background-color: #2b6cb0;
        color: white;
    }

    .share-buttons {
        margin-top: 1rem;
    }

    .save-button {
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        main.main-content {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 2rem;
        }

        .job-meta p {
            font-size: 1rem;
        }
    }
</style>
@section('content')
<main class="main-content">
    <h1 class="page-title">{{ $jobOffer->title }}</h1>

    <div class="job-meta">
        <p><strong>Company:</strong> <a href="">{{ $jobOffer->company }}</a></p>
        <p><strong>Location:</strong> {{ $jobOffer->location }}</p>
        <p><strong>Salary:</strong> {{ $jobOffer->salary ?? 'Not specified' }}</p>
        <p><strong>Description:</strong> {{ $jobOffer->description }}</p>
    </div>

    @if($jobOffer->image)
        <img src="{{ asset('storage/' . $jobOffer->image) }}" alt="{{ $jobOffer->title }}" style="width: 100%; height: auto; margin-top: 1.5rem; border-radius: 6px;">
    @endif

    <div class="share-buttons">
        <button class="button button-outline" onclick="shareJob('{{ url()->current() }}')">Share Job</button>
    </div>


    <a class="button button-secondary" style="margin-top: 1rem;" href="{{ route('jobs.index') }}" class="back-button">
        ← Return to Job Listings
    </a>
</main>

<script>
    function shareJob(url) {
        const shareData = {
            title: document.querySelector('.page-title').innerText,
            text: 'Check out this job offer:',
            url: url
        };

        if (navigator.share) {
            navigator.share(shareData).catch(err => console.error('Sharing failed', err));
        } else {
            prompt('Copy this link to share:', url);
        }
    }
</script>
@endsection
