<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres d'Emploi</title>
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

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        li h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }

        li p {
            color: #555;
            font-size: 1rem;
            margin: 5px 0;
        }

        li p strong {
            color: #333;
        }

        img {
            max-width: 200px;
            margin-top: 10px;
            display: block;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .actions a, .actions button {
            text-decoration: none;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            color: white;
            cursor: pointer;
        }

        .actions a {
            background-color: #4CAF50;
        }

        .actions button {
            background-color: #FF5733;
        }

        .actions a:hover {
            background-color: #45a049;
        }

        .actions button:hover {
            background-color: #c44127;
        }

        .return-link {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin: 10px;
        }

        .return-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Mes Offres d'Emploi</h1>

    @if(session('success'))
        <div style="color: green; font-weight: bold; text-align: center; margin-bottom: 20px;">
            {{ session('success') }}
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

                <!-- Display image if it exists -->
                @if($jobOffer->image)
                    <img src="{{ asset('storage/' . $jobOffer->image) }}" alt="{{ $jobOffer->title }}">
                @endif

                <form action="{{ route('job-offers.apply', $jobOffer->id) }}" method="POST">
                    @csrf
                    <!-- Your form fields here -->
                    <button type="submit">Apply</button>
                </form>
                
                

                <!-- Edit and Delete links -->
                <div class="actions">
                    <a href="{{ route('job-offers.edit', $jobOffer->id) }}">Editer</a>
                    <form action="{{ route('job-offers.destroy', $jobOffer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('job-offers.create') }}" class="return-link">Ajouter une nouvelle offre</a>
    <a href="{{ route('dashboard') }}" class="return-link">Retour au tableau de bord</a>
</body>
</html>
