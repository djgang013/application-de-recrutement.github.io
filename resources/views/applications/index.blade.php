<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Candidatures</title>
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

        body {
            font-family: Arial, sans-serif;
            background-color: var(--gray-50);
            margin: 0;
            padding: 2rem;
            color: var(--gray-800);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 2rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        header h1 {
            font-size: 2rem;
            color: var(--gray-800);
        }

        header a {
            padding: 0.75rem 1.5rem;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
        }

        .applications-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .application-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 0.75rem;
            overflow: hidden;
            transition: transform 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .application-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 1.5rem;
        }

        .application-header {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .meta-info p {
            margin: 0.5rem 0;
        }

        .actions {
            margin-top: 1rem;
            display: flex;
            gap: 0.75rem;
        }

        .actions a, .actions button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .primary-button {
            background-color: var(--primary);
            color: white;
        }

        .primary-button:hover {
            background-color: var(--primary-dark);
        }

        .danger-button {
            background-color: #e74c3c;
            color: white;
        }

        .danger-button:hover {
            background-color: #c0392b;
        }

        .text-center {
            text-align: center;
            padding: 2rem 0;
            color: var(--gray-600);
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Liste des Candidatures</h1>
            <a href="{{ route('dashboard') }}">Retour au tableau de bord</a>
        </header>

        @if($applications->isEmpty())
            <div class="text-center">Aucune candidature trouvée.</div>
        @else
            <div class="applications-grid">
                @foreach($applications as $application)
                    <div class="application-card">
                        @if($application->jobOffer->image)
                            <img src="{{ asset('storage/' . $application->jobOffer->image) }}" alt="{{ $application->jobOffer->title }}" class="card-image">
                        @endif
                        <div class="card-content">
                            <div class="application-header">{{ $application->jobOffer->title }}</div>
                            <div class="meta-info">
                                <p><strong>Candidat:</strong> {{ $application->user->name }}</p>
                                <p><strong>Date de la candidature:</strong> {{ $application->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="actions">
                                @if($application->cv_path)
                                    <a href="{{ asset('storage/' . $application->cv_path) }}" class="primary-button" target="_blank">Voir CV</a>
                                @else
                                    <span>Pas de CV</span>
                                @endif
                                @if($application->cover_letter_path)
                                    <a href="{{ asset('storage/' . $application->cover_letter_path) }}" class="primary-button" target="_blank">Voir Lettre</a>
                                @else
                                    <span>Pas de lettre</span>
                                @endif
                                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette candidature?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="danger-button">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
