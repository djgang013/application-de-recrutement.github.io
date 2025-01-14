@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --primary-light: #3b82f6;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --error: #ef4444;
}

body {
    background-color: var(--gray-50);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    margin: 0;
    padding: 0;
}

.register-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}

.register-card {
    background: white;
    width: 100%;
    max-width: 480px;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    padding: 2.5rem;
}

.register-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.register-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 0.75rem;
}

.register-subtitle {
    color: var(--gray-600);
    font-size: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
    width: 90%;
}

.form-label {
    display: block;
    color: var(--gray-700);
    font-size: 0.938rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-input,
.form-select {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 1px solid var(--gray-200);
    border-radius: 0.5rem;
    font-size: 0.938rem;
    color: var(--gray-800);
    background-color: white;
    transition: all 0.2s ease;
}

.form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

.form-input:focus,
.form-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.btn {
    display: inline-block;
    width: 100%;
    padding: 0.875rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    font-size: 1rem;
    text-align: center;
    transition: all 0.2s ease;
    cursor: pointer;
    border: none;
}

.btn-primary {
    background-color: var(--primary);
    color: white;
    margin-top: 1rem;
    width: 90%;
}

.btn-primary:hover {
    background-color: var(--primary-dark);
}

.login-link {
    text-align: center;
    margin-top: 1.5rem;
    font-size: 0.938rem;
    color: var(--gray-600);
}

.login-link a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    margin-left: 0.25rem;
}

.login-link a:hover {
    text-decoration: underline;
}

.alert-error {
    background-color: #fef2f2;
    border: 1px solid #fee2e2;
    color: var(--error);
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    font-size: 0.875rem;
}

@media (max-width: 640px) {
    .register-card {
        padding: 1.5rem;
    }
}
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h1 class="register-title">Create Account</h1>
            <p class="register-subtitle">Fill in your details to get started</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-input" 
                    placeholder="Enter your full name"
                    value="{{ old('name') }}" 
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input" 
                    placeholder="Enter your email"
                    value="{{ old('email') }}" 
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Create a password"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="form-input" 
                    placeholder="Confirm your password"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="role">Account Type</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="candidat">Candidate</option>
                    <option value="recruteur">Recruiter</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                Create Account
            </button>

            <div class="login-link">
                Already have an account?
                <a href="{{ route('login') }}">Sign in</a>
            </div>
        </form>
    </div>
</div>
@endsection