<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter CV</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
        }

        h1 {
            color: #1e293b;
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        form {
            width: 100%;
            max-width: 32rem;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        .file-input-container {
            border: 2px dashed #cbd5e1;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .file-input-container:hover {
            border-color: var(--primary);
        }

        input[type="file"] {
            display: none;
        }

        .upload-icon {
            color: #64748b;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        button {
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            margin-top: 1.5rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background: var(--primary-dark);
        }

        .back-link {
            margin-top: 1.5rem;
            color: #475569;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link:hover {
            color: var(--primary);
        }

        @media (max-width: 640px) {
            body {
                padding: 1rem;
            }

            form {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <h1>Ajouter votre CV</h1>
    
    <form action="{{ route('cvs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="cv">Télécharger le CV (PDF)</label>
        <div class="file-input-container" onclick="document.getElementById('cv').click()">
            <div class="upload-icon">📄</div>
            <p>Cliquez ou glissez votre fichier PDF ici</p>
        </div>
        <input type="file" name="cv" id="cv" accept=".pdf" required>
        <button type="submit">Télécharger</button>
    </form>

    <a href="{{ route('dashboard') }}" class="back-link">
        ← Retour au tableau de bord
    </a>
</body>
</html>