<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f0f2f5;
            color: #1a1a1a;
            line-height: 1.6;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(to right, #4CAF50, #45a049);
            padding: 1rem 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar-user {
            color: white;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background: #c82333;
        }

        /* Main Content Styles */
        .main-content {
            margin-top: 80px;
            padding: 2rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .welcome-section {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            margin-bottom: 2rem;
        }

        .welcome-section h1 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .welcome-section p {
            color: #666;
            font-size: 1.1rem;
        }

        /* Action Cards */
        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .action-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .action-card a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Recruiter Dashboard Specific */
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .navbar-content {
                flex-direction: column;
                gap: 1rem;
            }

            .main-content {
                padding: 1rem;
                margin-top: 120px;
            }

            .welcome-section {
                padding: 1.5rem;
            }

            .welcome-section h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="#" class="navbar-brand">JobBoard</a>
            <div class="navbar-user">
                <span>{{ $user->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="welcome-section">
            <h1>Welcome, {{ $user->name }} (Recruteur)</h1>
            <p>Manage your job offers and applications</p>
        </div>

        <ul>
            <li><a href="{{ route('job-offers.create') }}">Add a Job Offer</a></li>
            <li><a href="{{ route('job-offers.index') }}">Manage Job Offers</a></li>
            <li><a href="{{ route('applications.index') }}">View Applications</a></li>
        </ul>

        <div class="action-grid">
            <div class="action-card">
                <a href="{{ route('cvs.create') }}">Upload CV</a>
            </div>
            <div class="action-card">
                <a href="{{ route('cover-letters.index') }}">Cover Letters</a>
            </div>
            <div class="action-card">
                <a href="{{ route('jobs.index') }}">View Job Offers</a>
            </div>
        </div>
    </div>
</body>
</html>
