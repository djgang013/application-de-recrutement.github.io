<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Lettre de Motivation</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }

        .form-actions {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Modifier la Lettre de Motivation</h1>

    <form action="{{ route('cover-letters.update', $coverLetter) }}" method="POST">
        @csrf
        @method('PUT') <!-- This is to tell Laravel that we're updating the resource -->

        <label for="title">Titre de la lettre:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $coverLetter->title) }}" required>

        <label for="content">Contenu de la lettre:</label>
        <textarea name="content" id="content" rows="6" required>{{ old('content', $coverLetter->content) }}</textarea>

        <div class="form-actions">
            <button type="submit">Enregistrer les modifications</button>
        </div>
    </form>

    <div class="form-actions">
        <a href="{{ route('cover-letters.index') }}">Retour</a>
    </div>
</body>
</html>
