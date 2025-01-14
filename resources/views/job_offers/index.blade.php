<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Job Board</title>
    <style>
        :root {
            --primary-color: #1a365d;
            --secondary-color: #2b6cb0;
            --accent-color: #4299e1;
            --background-color: #f7fafc;
            --text-color: #2d3748;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }

        .navbar-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .navbar-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .navbar-links a:hover {
            background-color: var(--background-color);
            color: var(--secondary-color);
        }

        .main-content {
            max-width: 1400px;
            margin: 6rem auto 2rem;
            padding: 0 2rem;
        }

        .page-title {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .job-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 2rem;
        }

        .job-card  {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid var(--border-color);
            position: relative;
        }

        .job-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .job-title {
            color: var(--primary-color);
            font-size: 1.25rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .job-description {
            color: var(--text-color);
            margin-bottom: 1.5rem;
        }

        .job-meta {
            display: grid;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .job-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-color);
            font-size: 0.95rem;
        }

        .job-meta-item strong {
            color: var(--primary-color);
            font-weight: 600;
        }

        .button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            text-align: center;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .button-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .button-primary:hover {
            background-color: var(--secondary-color);
        }

        .button-secondary {
            background-color: var(--accent-color);
            color: white;
        }

        .button-secondary:hover {
            background-color: var(--secondary-color);
        }

        .file-input-group {
            margin-bottom: 1rem;
        }

        .file-input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
            font-weight: 500;
        }

        .file-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: white;
        }

        .hidden-form {
            display: none;
            animation: slideDown 0.3s forwards;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert {
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .alert-success {
            background-color: #c6f6d5;
            color: #2f855a;
        }

        .alert-error {
            background-color: #fed7d7;
            color: #c53030;
        }

        @media (max-width: 768px) {
            .job-grid {
                grid-template-columns: 1fr;
            }

            .navbar-content {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-links {
                flex-direction: column;
                width: 100%;
            }

            .navbar-links a {
                width: 100%;
                text-align: center;
            }
        }
    </style>
    <script>
        function toggleForm(jobId) {
            const button = document.getElementById(`apply-button-${jobId}`);
            const form = document.getElementById(`apply-form-${jobId}`);

            if (form && button) {
                if (form.style.display === "none" || !form.style.display) {
                    form.style.display = "block";
                    button.style.display = "none";
                } else {
                    form.style.display = "none";
                }
            }
        }
    </script>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            @if(auth()->check()  )
            <a href="{{ route('dashboard') }}" class="navbar-brand">JobBoard</a>
            @else
            <p class="navbar-brand">JobBoard</p>
            @endif
            <div class="navbar-links">
                @auth
                    @if(auth()->user()->role == 'recruteur')
                        <a href="{{ route('job-offers.create') }}">Add Job Offer</a>
                        <a href="{{ route('applications.index') }}">Applications</a>
                    @else
                        <a href="{{ route('candidate.applications') }}">My Applications</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="button button-secondary">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="main-content">
        <h1 class="page-title">Available Positions</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="job-grid">
            @foreach($jobOffers as $jobOffer)
         
                <article class="job-card">
                    @if(auth()->check() && auth()->user()->role === 'candidat')
                   
                    <a   href="{{ route('job-offers.show', $jobOffer->id) }}" style="text-decoration: none; color: inherit;  " >
                        @endif
                    <h2 class="job-title">{{ $jobOffer->title }}</h2>
                    <p class="job-description">{{ $jobOffer->description }}</p>

                    <div class="job-meta">
                        <div class="job-meta-item">
                            <strong>Location:</strong> {{ $jobOffer->location }}
                        </div>
                        <div class="job-meta-item">
                            <strong>Company:</strong> {{ $jobOffer->company }}
                        </div>
                        <div class="job-meta-item">
                            <strong>Salary:</strong> {{ $jobOffer->salary ?? 'Not specified' }}
                        </div>
                    </div>

                    @if($jobOffer->image)
                   
                        <img src="{{ asset('storage/' . $jobOffer->image) }}" alt="{{ $jobOffer->title }}" style="width: 100%; height: auto; margin-bottom: 1.5rem; border-radius: 6px;" >
                  
                        
                    @endif
                </a>
                    @if(auth()->check() && auth()->user()->role === 'candidat')
                   
                        <button id="apply-button-{{ $jobOffer->id }}" class="button button-primary" onclick="toggleForm({{ $jobOffer->id }})">Apply</button>

                        <form id="apply-form-{{ $jobOffer->id }}" class="hidden-form" action="{{ route('job-offers.apply', $jobOffer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="file-input-group">
                                <label for="cover_letter">Cover Letter</label>
                                <input type="file" name="cover_letter" id="cover_letter" class="file-input" accept=".pdf,.doc,.docx">
                            </div>
                            <div class="file-input-group">
                                <label for="cv">Resume/CV</label>
                                <input type="file" name="cv" id="cv" class="file-input" accept=".pdf">
                            </div>
                            <button type="submit" class="button button-primary">Apply Now</button>
                            
                        </form> 
                        @else
                        @if(!auth()->check())
                            <a class="button button-primary" href ="{{ route('login') }}">Login to apply</a>
                    @endif
                    @endif
                             
                    @auth
                        @if(auth()->user()->role == 'recruteur')
                            <a href="{{ route('job-offers.edit', $jobOffer->id) }}" class="button button-secondary" style="margin-top: 1rem;">Edit</a>
                            <form action="{{ route('job-offers.destroy', $jobOffer->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-secondary" style="margin-top: 1rem;">Delete</button>
                            </form>
                        @endif
                    @endauth
                </article>
            @endforeach
        </div>
    </main>
</body>
</html>
