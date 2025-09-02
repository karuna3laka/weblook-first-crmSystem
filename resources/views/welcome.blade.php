<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kavindu's Weblook CRM</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        /* Base */
        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(145deg, #111, #1a1a1a);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Card Container */
        .container {
            text-align: center;
            max-width: 450px;
            width: 90%;
            padding: 3rem 2rem;
            background: #121212;
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
        }

        /* Headings */
        h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
            color: #fff;
        }

        p {
            font-size: 1rem;
            color: #ccc;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        /* Buttons */
        .button {
            display: inline-block;
            margin: 0.5rem;
            padding: 0.8rem 2.2rem;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid #fff;
            text-decoration: none;
        }

        .button-login {
            background-color: #fff;
            color: #111;
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.1);
        }

        .button-login:hover {
            background-color: #f0f0f0;
            color: #111;
            transform: translateY(-2px);
        }

        .button-register {
            background-color: transparent;
            color: #fff;
            border: 2px solid #fff;
        }

        .button-register:hover {
            background-color: #fff;
            color: #111;
            transform: translateY(-2px);
        }

        /* Small Footer Links */
        .links {
            margin-top: 1rem;
        }

        @media (max-width: 500px) {
            .container {
                padding: 2rem 1.5rem;
            }

            h1 {
                font-size: 1.6rem;
            }

            .button {
                padding: 0.7rem 1.8rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Kavindu's Weblook CRM</h1>
        <p>Access your dashboard and manage your CRM efficiently. Login or register to continue.</p>

        <div class="links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="button button-login">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="button button-login">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="button button-register">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>
</html>
