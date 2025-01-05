<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Lettre de Motivation</title>
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
            color: #4CAF50;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            color: #007bff;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Ajouter Lettre de Motivation</h1>

    <form action="{{ route('cover-letters.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <label for="title">Titre de la lettre:</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
    
        <label for="content">Contenu de la lettre:</label>
        <textarea name="content" id="content" rows="6" required>{{ old('content') }}</textarea>
    
        <label for="file_path">Fichier (PDF, DOC, DOCX):</label>
        <input type="file" name="file_path" id="file_path" required>
    
        <button type="submit">Envoyer</button>
    </form>
    

    
    <a href="{{ route('dashboard') }}">Retour au tableau de bord</a>
</body>
</html>
