@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
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
}

.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
}

.login-card {
    background: white;
    width: 100%;
    max-width: 400px;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    padding: 2.5rem;  /* Increased padding */
}

.login-header {
    text-align: center;
    margin-bottom: 2.5rem;  /* Increased margin */
}

.login-title {
    font-size: 1.75rem;  /* Increased font size */
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 0.75rem;  /* Increased margin */
}

.login-subtitle {
    color: var(--gray-600);
    font-size: 1rem;  /* Increased font size */
}

.form-group {
    margin-bottom: 1.75rem;  /* Increased margin */
    width: 90%;
}

.form-label {
    display: block;
    color: var(--gray-700);
    font-size: 0.938rem;  /* Adjusted font size */
    font-weight: 500;
    margin-bottom: 0.625rem;  /* Adjusted margin */
}

.form-input {
    width: 100%;
    padding: 0.875rem 1rem;  /* Adjusted padding */
    border: 1px solid var(--gray-200);
    border-radius: 0.5rem;
    font-size: 1rem;  /* Increased font size */
    color: var(--gray-800);
    background-color: white;
    transition: all 0.2s ease;
}

.form-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.btn {
    display: inline-block;
    width: 100%;
    padding: 0.875rem 1.5rem;  /* Adjusted padding */
    border-radius: 0.5rem;
    font-weight: 500;
    font-size: 1rem;  /* Added font size */
    text-align: center;
    transition: all 0.2s ease;
    cursor: pointer;
    border: none;
}

.btn-primary {
    background-color: var(--primary);
    color: white;
    margin-top: 0.5rem;  /* Added margin top */
}

.btn-primary:hover {
    background-color: var(--primary-dark);
}

.btn-secondary {
    background-color: var(--gray-100);
    color: var(--gray-700);
    margin-top: 1.25rem;  /* Increased margin */
    width: 90%;
}

.btn-secondary:hover {
    background-color: var(--gray-200);
}

.divider {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 2rem 0;  /* Increased margin */
    color: var(--gray-600);
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid var(--gray-200);
}

.divider span {
    padding: 0 1rem;
    font-size: 0.938rem;  /* Adjusted font size */
}

.register-link {
    text-align: center;
    margin-top: 2rem;  /* Increased margin */
    font-size: 0.938rem;  /* Adjusted font size */
    color: var(--gray-600);
}

.register-link a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
}

.register-link a:hover {
    text-decoration: underline;
}

@media (max-width: 640px) {
    .login-card {
        padding: 2rem;  /* Adjusted padding for mobile */
    }
}
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title">Welcome Back</h1>
            <p class="login-subtitle">Please sign in to your account</p>
        </div>

        @if(session('error'))
            <div class="alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" style="width: 20px; height: 20px;">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="email">Email address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input" 
                    placeholder="Enter your email"
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
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">
                Sign in
            </button>

            <div class="divider">
                <span>or</span>
            </div>

            <a href="{{ route('guest.jobs') }}" class="btn btn-secondary">
                Continue comme invité
            </a>

            <div class="register-link">
                Don't have an account? 
                <a href="{{ route('register') }}">Create one now</a>
            </div>
        </form>
    </div>
</div>
@endsection