@extends('layouts.app')

@section('title', 'Register')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Glassmorphism Register Form Tutorial in HTML CSS</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <style media="screen">
        /* General Reset */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #080710;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad, #23a2f6);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right, #ff512f, #f09819);
            right: -30px;
            bottom: -80px;
        }

        form {
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255, 255, 255, 0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }

        label[for="role"] {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
            color: #ffffff; /* White color for the label */
        }

        select#role {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07); /* Light transparent background */
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
            color: #e5e5e5; /* Light gray text for options */
            border: 1px solid rgba(255, 255, 255, 0.3); /* Border with slight transparency */
        }

        select#role option {
            background-color: #080710; /* Dark background color for the options */
            color: #ffffff; /* White text color for options */
        }

        select#role option:hover {
            background-color: #23a2f6; /* Highlight color when hovering over options */
            color: #080710; /* Change text color to dark when hovering */
        }

        /* Login Link Styles */
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
        }
        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <h3>Create Account</h3>

        @if ($errors->any())
            <div class="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
            </div>
        @endif

<label for="name">Full Name</label>
<input type="text" placeholder="Enter your name" id="name" name="name" value="{{ old('name') }}" required>

<label for="email">Email</label>
<input type="email" placeholder="Enter your email" id="email" name="email" value="{{ old('email') }}" required>

<label for="password">Password</label>
<input type="password" placeholder="Enter your password" id="password" name="password" required>

<label for="password_confirmation">Confirm Password</label>
<input type="password" placeholder="Confirm your password" id="password_confirmation" name="password_confirmation" required>

<label for="role">Role</label>
<select id="role" name="role" required>
    <option value="candidat">Candidat</option>
    <option value="recruteur">Recruteur</option>
</select>

<button type="submit">Register</button>

<!-- Login Link -->
<div class="login-link">
    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</div>
</form>
</body>
</html>

@endsection