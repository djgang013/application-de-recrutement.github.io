<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Lettres de Motivation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        ul li {
            margin: 15px 0;
        }

        ul li a {
            text-decoration: none;
            font-size: 18px;
            color: #007bff;
            margin-right: 15px;
            transition: color 0.3s;
        }

        ul li a:hover {
            color: #0056b3;
        }

        ul li form button {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 5px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        ul li form button:hover {
            background-color: #c82333;
        }

        .actions {
            display: inline-block;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .logout-btn {
            padding: 10px 20px;
            background-color: #dc3545;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Mes Lettres de Motivation</h1>

    @if($letters->isEmpty())
        <p>Vous n'avez pas encore téléchargé de lettre de motivation.</p>
    @else
        <ul>
            @foreach($letters as $letter)
                <li>
                    <strong>{{ $letter->title }}</strong>

                    <div class="actions">
                        
                        <a href="{{ route('cover-letters.edit', $letter) }}">Modifier</a>

                        <form action="{{ route('cover-letters.destroy', $letter) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="button-container">
        <a href="{{ route('cover-letters.create') }}" class="logout-btn">Ajouter une nouvelle lettre</a>
        <a href="{{ route('dashboard') }}" class="logout-btn">Retour au tableau de bord</a>
    </div>

</body>
</html>
