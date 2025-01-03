<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications List</title>
    <style>
        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        /* Header styling */
        th {
            background-color: #4CAF50;
            color: white;
            font-size: 1.1rem;
        }

        /* Row styling */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Badge styling for status */
        .badge {
            padding: 5px 10px;
            font-size: 0.9rem;
            border-radius: 15px;
            color: white;
            text-transform: capitalize;
        }

        .badge-warning {
            background-color: #ff9800;
        }

        .badge-success {
            background-color: #4caf50;
        }

        .badge-danger {
            background-color: #f44336;
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
        /* Form styling */
        form {
            margin: 0;
            padding: 0;
        }

        .select-wrapper {
            width: 100%;
        }

        /* Select dropdown styling */
        .select-wrapper select {
            padding: 5px 10px;
            font-size: 0.9rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }

        /* Center align empty row message */
        .text-center {
            text-align: center;
            color: #555;
            font-size: 1rem;
            padding: 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 10px 12px;
            }
        }
    </style>
</head>
<body>
    <h1>Liste des Candidatures</h1>

    <table>
        <thead>
            <tr>
                <th>Titre de l'offre</th>
                <th>Candidat</th>
                <th>Status</th>
                <th>Date de la candidature</th>
                <th>Modifier le statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
                <tr>
                    <td>{{ $application->jobOffer->title }}</td>
                    <td>{{ $application->user->name }}</td>
                    <td>
                        <span class="badge badge-{{ $application->status === 'pending' ? 'warning' : ($application->status === 'accepted' ? 'success' : 'danger') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </td>
                    <td>{{ $application->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('applications.update-status', $application->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="form-control form-control-sm">
                                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>Acceptée</option>
                                <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Refusée</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune candidature trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}" class="return-link">Retour au tableau de bord</a>
</body>
</html>
