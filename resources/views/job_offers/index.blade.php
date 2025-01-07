<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres d'Emploi</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding-top: 70px;
            color: #2d3748;
            line-height: 1.6;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            padding: 1rem 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .navbar-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s ease;
        }

        .navbar-links a:hover {
            opacity: 0.8;
        }

        .mobile-menu-button {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Main Content Styles */
        h1 {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-size: 2.2rem;
            margin: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.5px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            text-align: center;
            margin: 1rem auto;
            max-width: 900px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Job Listings */
        ul {
            list-style-type: none;
            padding:0% 0%;
            margin: 1rem auto;
            
            max-width: 1300px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
            justify-content: center;
        }

        li {
            margin:0 -10px 0 -10px;
            background-color: white;
            border-radius: 8px;
            padding: 1rem;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease forwards;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        li h3 {
            font-size: 1.3rem;
            margin: 0 0 1rem 0;
        }

        li:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        li p {
            color: #4a5568;
            margin: 0.7rem 0;
        }

        li p strong {
            color: #2d3748;
            font-weight: 600;
        }

        /* Form Elements */
        .form-group {
            margin: 1.5rem 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4a5568;
            font-weight: 500;
        }

        .form-group input[type="file"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            background-color: #f8fafc;
            transition: border-color 0.2s ease;
        }

        .form-group input[type="file"]:hover {
            border-color: #cbd5e0;
        }

        button[type="submit"] {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            width: 100%;
            margin-top: 1rem;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(49, 130, 206, 0.2);
        }

        /* Action Buttons */
        .actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .actions a,
        .actions button {
            flex: 1;
            padding: 0.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .actions a {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .actions button {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
            border: none;
        }

        .return-link {
            display: inline-block;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            margin: 1rem;
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .return-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(49, 130, 206, 0.2);
        }

        @media (max-width: 768px) {
            .navbar-content {
                position: relative;
            }

            .mobile-menu-button {
                display: block;
            }

            .navbar-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
                flex-direction: column;
                padding: 1rem;
                gap: 1rem;
            }

            .navbar-links.active {
                display: flex;
            }

            .actions {
                flex-direction: column;
            }

            .actions a,
            .actions button {
                width: 100%;
            }

            .return-link {
                width: 100%;
            }

            h1 {
                font-size: 1.8rem;
                padding: 1rem;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        html {
            scroll-behavior: smooth;
        }

        img {
            max-width: 100%;
            height: auto;
        }
        .error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 1rem;
    text-align: center;
    margin: 1rem auto;
    max-width: 900px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand">JobBoard</a>
            <button class="mobile-menu-button">☰</button>
            <div class="navbar-links">
                @if (auth()->check() && auth()->user()->role == 'candidate')
                
@endif

                @auth
                    @if(auth()->user()->role == 'recruteur')
                        <a href="{{ route('job-offers.create') }}">Ajouter une offre</a>
                        <a href="{{ route('applications.index') }}">Candidatures</a>
                    @endif
                    @if(auth()->user()->role !== 'recruteur')
                    <a href="{{ route('candidate.applications') }}">My Applications</a>
                    
                    <a href="{{route('cvs.create')}}">ajouter votre cv</a>
                    <a href="{{ route('cover-letters.index') }}">Lettres de motivation</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" >
                            Se déconnecter
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Se connecter</a>
                    <a href="{{ route('register') }}">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <h1>Mes Offres d'Emploi</h1>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
    <div class="error-message">
        {{ session('error') }}
    </div>
@endif

    <ul>
        @foreach($jobOffers as $jobOffer)
            <li>
                <h3>{{ $jobOffer->title }}</h3>
                <p>{{ $jobOffer->description }}</p>
                <p><strong>Lieu:</strong> {{ $jobOffer->location }}</p>
                <p><strong>Entreprise:</strong> {{ $jobOffer->company }}</p>
                <p><strong>Salaire:</strong> {{ $jobOffer->salary ?? 'Non spécifié' }}</p>

                @if($jobOffer->image)
                    <img src="{{ asset('storage/' . $jobOffer->image) }}" alt="{{ $jobOffer->title }}">
                @endif

                @auth
                    @if(auth()->user()->role === 'candidat')
                        <form action="{{ route('job-offers.apply', $jobOffer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cover_letter">Lettre de motivation</label>
                                <input type="file" name="cover_letter" id="cover_letter" class="form-control" accept=".pdf,.doc,.docx">
                            </div>
                            <div class="form-group">
                                <label for="cv">Curriculum Vitae</label>
                                <input type="file" name="cv" id="cv" class="form-control" accept=".pdf">
                            </div>
                            <button type="submit">Postuler</button>
                        </form>
                    @endif

                    @if(auth()->user()->role === 'recruteur')
                        <div class="actions">
                            <a href="{{ route('job-offers.edit', $jobOffer->id) }}">Editer</a>
                            <form action="{{ route('job-offers.destroy', $jobOffer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="actions">
                        <a href="{{ route('login') }}" style="background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);">
                            Se connecter pour postuler
                        </a>
                    </div>
                @endauth
            </li>
        @endforeach
    </ul>
    


    <script>
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.navbar-links').classList.toggle('active');
        });
    </script>

    
   

    <script>
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.navbar-links').classList.toggle('active');
        });
    </script>
</body>
</html>
