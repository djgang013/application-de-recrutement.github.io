<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Candidat</title>

    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
            color: #333;
        }

        h1, h3 {
            color: #4CAF50;
        }

        /* Header Section */
        .header {
            text-align: center;
            padding: 30px 0;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 18px;
            color: #777;
        }

        /* Navigation */
        ul {
            display: flex;
            justify-content: center;
            padding: 0;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        ul li {
            list-style: none;
            margin: 10px 15px;
        }

        ul li a {
            display: inline-block;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 6px;
            text-align: center;
            width: 200px;
            transition: background-color 0.3s;
        }

        ul li a:hover {
            background-color: #0056b3;
        }

        /* CV and Cover Letter Download Section */
        .cv-download, .cover-letter-download {
            text-align: center;
            margin-top: 30px;
        }

        .cv-download a, .cover-letter-download a {
            font-size: 18px;
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 6px;
            border: 1px solid #28a745;
            transition: background-color 0.3s, color 0.3s;
        }

        .cv-download a:hover, .cover-letter-download a:hover {
            background-color: #28a745;
            color: white;
        }

        /* No CV / No Cover Letter Message */
        .no-cv, .no-cover-letter {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #6c757d;
        }

        /* Logout Button */
        .logout-btn-container {
            text-align: center;
            margin-top: 30px;
        }

        .logout-btn {
            padding: 12px 30px;
            background-color: #dc3545;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            ul {
                flex-direction: column;
                align-items: center;
            }

            ul li a {
                width: 80%;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bienvenue, {{ $user->name }} (Candidat)</h1>
        <p>Voici vos actions disponibles</p>
    </div>

    <!-- Navigation -->
    <ul>
        <li><a href="{{ route('cvs.create') }}">Ajouter CV</a></li>
        <li><a href="{{ route('cover-letters.index') }}">Lettres de motivation</a></li>
        <li><a href="{{ route('jobs.index') }}">Consulter les offres d'emploi disponibles</a></li>
       
    </ul>

    <!-- CV Download Section -->
    @if(auth()->user()->cv_path)
        <div class="cv-download">
            <a href="{{ route('cvs.download', auth()->user()) }}">Télécharger votre CV</a>
        </div>
    @else
        <div class="no-cv">
            <p>Vous n'avez pas encore téléchargé de CV.</p>
        </div>
    @endif

    <!-- Logout Button -->
    <div class="logout-btn-container">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Se déconnecter</button>
        </form>
    </div>
</body>
</html>
