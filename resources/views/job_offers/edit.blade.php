<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer l'Offre d'Emploi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        form {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 1rem;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button,a {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .image-preview {
            margin-top: 10px;
        }
    </style>
</head>
<body>
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
                    <img src="{{ asset('storage/' . $jobOffer->image) }}" alt="Image de l'offre" style="max-width: 200px;">
                </div>
            @endif
        </div>

        <button type="submit">Mettre à jour l'Offre</button>
        <a href="{{ route('dashboard') }}" class="return-link">Retour au tableau de bord</a>
    </form>
</body>
</html>
