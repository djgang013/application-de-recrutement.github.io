<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Recruteur</title>
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
            margin: 0;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
        }

        li {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        li a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
            font-size: 1.2rem;
            display: block;
        }

        li a:hover {
            color: #45a049;
            text-decoration: underline;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        button {
            background-color: #FF5733;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h1>Welcome, {{ $user->name }} (Recruteur)</h1>

    <h3>Actions disponibles:</h3>
    
<ul>
    <!-- Link to add a new job offer -->
    <li><a href="{{ route('job-offers.create') }}">Ajouter une offre</a></li>

    <!-- Link to manage job offers -->
    <li><a href="{{ route('job-offers.index') }}">Gérer les offres d'emploi (Modifier, Supprimer)</a></li>

    <!-- Link to view applications -->
    <li><a href="{{ route('applications.index') }}">Voir les candidatures reçues</a></li>
</ul>

    <!-- Logout button -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
