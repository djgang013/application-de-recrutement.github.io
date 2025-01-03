<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter CV</title>

    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }

        /* Header Section */
        h1 {
            text-align: center;
            margin-top: 50px;
            color: #4CAF50;
        }

        /* Form Section */
        form {
            max-width: 500px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-size: 16px;
            margin-bottom: 10px;
        }

        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Back Link */
        a {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            form {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <h1>Ajouter votre CV</h1>

    <form action="{{ route('cvs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="cv">Télécharger le CV (PDF):</label>
        <input type="file" name="cv" id="cv" accept=".pdf" required>
        <button type="submit">Télécharger</button>
    </form>

    <a href="{{ route('dashboard') }}">Retour au tableau de bord</a>
</body>
</html>
