<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Offre d'Emploi</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #333;
        }

        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        button, a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            text-align: center;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 10px;
            text-decoration: none;
        }

        button:hover, a:hover {
            background-color: #45a049;
        }

        /* Button and link in the same style */
        a {
            background-color: #007BFF;
            margin-top: 10px;
        }

        a:hover {
            background-color: #0056b3;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 1.8rem;
                padding: 15px;
            }

            .form-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <h1>Ajouter une Offre d'Emploi</h1>

    <div class="form-container">
        <form action="{{ route('job-offers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="title">Titre de l'offre:</label>
            <input type="text" name="title" id="title" required><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea><br>

            <label for="location">Lieu:</label>
            <input type="text" name="location" id="location" required><br>

            <label for="company">Entreprise:</label>
            <input type="text" name="company" id="company" required><br>

            <label for="salary">Salaire:</label>
            <input type="text" name="salary" id="salary"><br>

            <label for="image">Image de l'offre (optionnelle):</label>
            <input type="file" name="image" id="image" accept="image/*"><br>

            <button type="submit">Ajouter l'Offre</button>
            <a href="{{ route('dashboard') }}" class="return-link">Retour au tableau de bord</a>
        </form>
    </div>
</body>
</html>
