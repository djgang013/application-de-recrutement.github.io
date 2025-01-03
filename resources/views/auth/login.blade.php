@extends('layouts.app')

@section('title', 'Login')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Glassmorphism Login Form Tutorial in HTML CSS</title>
  
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  
  <style media="screen">
    /* Resetting and Styling */
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

    .register-link {
      text-align: center;
      margin-top: 20px;
    }

    .register-link a {
      color: #ffffff;
      text-decoration: none;
      font-size: 14px;
      font-weight: 400;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    /* Continue as Guest Button */
    .guest-btn {
      margin-top: 20px;
      width: 100%;
      background-color: #666666;
      color: #ffffff;
      padding: 15px 0;
      font-size: 18px;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
    }
    .guest-btn:hover {
      background-color: #888888;
    }

    /* Error message styles */
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

    <form action="{{ route('login.post') }}" method="POST">
        @csrf  <!-- CSRF protection for form submission -->
        <h3>Login Here</h3>

        <!-- Display error message if login fails -->
        @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <label for="email">Email</label>
        <input type="email" placeholder="Email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>

        <button type="submit">Log In</button>

        <!-- Continue as Guest Button -->
        <div>
            <a href="{{ route('guest.jobs') }}">
                <button type="button" class="guest-btn">Continue as Guest</button>
            </a>
        </div>

        <!-- Register Link -->
        <div class="register-link">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </form>
</body>
</html>

@endsection
