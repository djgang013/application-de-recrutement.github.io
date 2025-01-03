<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Offre d'Emploi</title>
    <style>
        /* Add the CSS styles here */
        /* You can reuse the previous styles or add new styles for the file input */
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
            background-color: white;
            padding: 30px;
            margin: 20px auto;
            width: 50%;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
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

        button{
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
        }
        a{
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            
        }

        button:hover {
            background-color: #45a049;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
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
            <button><a href="{{ route('dashboard') }}" class="return-link">Retour au tableau de bord</a></button>
        </form>
       
    </div>
</body>
</html>
