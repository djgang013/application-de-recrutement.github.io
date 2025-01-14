<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer l'Offre d'Emploi</title>
    <style>
        :root {
            --primary-color: #0066cc;
            --primary-dark: #004c99;
            --background-light: #f8f9fa;
            --text-dark: #212529;
            --form-bg: #ffffff;
            --border-color: #dee2e6;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding: 2rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background-color: var(--form-bg);
            border-radius: 8px;
            box-shadow: 0 4px 8px var(--shadow-color);
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 0.875rem;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        button,
        .return-link {
            display: inline-block;
            padding: 0.875rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button {
            background-color: var(--primary-color);
            color: white;
        }

        button:hover {
            background-color: var(--primary-dark);
        }

        .return-link {
            background-color: var(--border-color);
            color: var(--text-dark);
            text-decoration: none;
            margin-top: 1rem;
        }

        .return-link:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .image-preview img {
            max-width: 200px;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }

            button,
            .return-link {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editer l'Offre d'Emploi</h1>

        <form action="{{ route('job-offers.update', $jobOffer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titre de l'offre:</label>
                <input type="text" name="title" id="title" value="{{ $jobOffer->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" required>{{ $jobOffer->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="location">Lieu:</label>
                <input type="text" name="location" id="location" value="{{ $jobOffer->location }}" required>
            </div>

            <div class="form-group">
                <label for="company">Entreprise:</label>
                <input type="text" name="company" id="company" value="{{ $jobOffer->company }}" required>
            </div>

            <div class="form-group">
                <label for="salary">Salaire:</label>
                <input type="text" name="salary" id="salary" value="{{ $jobOffer->salary }}">
            </div>

            <div class="form-group">
                <label for="image">Image de l'offre:</label>
                <input type="file" name="image" id="image">
                @if($jobOffer->image)
                    <div class="image-preview">
                        <img src="{{ asset('storage/' . $jobOffer->image) }}" alt="Image de l'offre">
                    </div>
                @endif
            </div>

            <div class="form-group button-group">
                <button type="submit">Mettre à jour l'Offre</button>
                <a href="{{ route('dashboard') }}" class="return-link">Retour au tableau de bord</a>
            </div>
        </form>
    </div>
</body>
</html>
