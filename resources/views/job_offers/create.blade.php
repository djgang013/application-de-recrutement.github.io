<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job Posting</title>
    <style>
        :root {
            --primary: #004085;
            --primary-dark: #002752;
            --success: #28a745;
            --success-hover: #218838;
            --gray-50: #f8f9fa;
            --gray-100: #e9ecef;
            --gray-200: #dee2e6;
            --gray-400: #adb5bd;
            --gray-600: #6c757d;
            --gray-800: #343a40;
            --gray-900: #212529;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-900);
            line-height: 1.6;
        }

        .page-container {
            max-width: 1000px;
            margin: 3rem auto;
            padding: 1.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 1rem;
        }

        .form-container {
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--gray-800);
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 0.875rem;
            border: 1px solid var(--gray-200);
            border-radius: 5px;
            font-size: 1rem;
            background: var(--gray-50);
        }

        .form-input:focus,
        .form-textarea:focus {
            border-color: var(--primary);
            outline: none;
        }

        .form-textarea {
            min-height: 150px;
        }

        .file-input-container {
            margin-top: 0.5rem;
        }

        .file-input {
            padding: 1rem;
            border: 2px dashed var(--gray-400);
            text-align: center;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background: var(--success);
            color: white;
        }

        .btn-primary:hover {
            background: var(--success-hover);
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-800);
        }

        .btn-secondary:hover {
            background: var(--gray-200);
        }

        .input-hint {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        @media (max-width: 768px) {
            .button-group {
                flex-direction: column;
                gap: 1rem;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="page-header">
            <h1 class="page-title">Create Job Posting</h1>
            <p class="page-subtitle">Fill in the details to create a new job opportunity</p>
        </div>

        <div class="form-container">
            <form action="{{ route('job-offers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-section">
                    <div class="form-group">
                        <label class="form-label" for="title">Job Title</label>
                        <input type="text" name="title" id="title" class="form-input" required placeholder="e.g. Senior Software Engineer">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="company">Company Name</label>
                        <input type="text" name="company" id="company" class="form-input" required placeholder="e.g. Tech Solutions Inc.">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-input" required placeholder="e.g. Paris, France">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="salary">Salary Range</label>
                        <input type="text" name="salary" id="salary" class="form-input" placeholder="e.g. €45,000 - €60,000 per year">
                        <p class="input-hint">Leave blank if you prefer not to disclose</p>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-group">
                        <label class="form-label" for="description">Job Description</label>
                        <textarea name="description" id="description" class="form-textarea" required placeholder="Describe the role, responsibilities, requirements, and benefits..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="image">Company Logo or Featured Image</label>
                        <div class="file-input-container">
                            <input type="file" name="image" id="image" class="file-input" accept="image/*">
                        </div>
                        <p class="input-hint">Recommended: Square image, minimum 400x400 pixels</p>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Publish Job Posting</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Return to Dashboard</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
