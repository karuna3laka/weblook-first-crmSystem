<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karunathilaka-CRM Login</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .animated-gradient-background {
            background: linear-gradient(-45deg, #1f2937, #111827, #000000, #1f2937);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
        }

        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>
<body class="animated-gradient-background text-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-gray-900/70 backdrop-blur-sm border border-gray-700 shadow-2xl rounded-2xl p-8 transform transition-transform duration-500 hover:scale-[1.01]">
        <h1 class="text-3xl font-extrabold text-white text-center mb-6">
            Welcome Back
        </h1>
        <p class="text-center text-sm text-gray-400 mb-8">
            Please log in to access your Weblook CRM account.
        </p>
        {{ $slot }}
    </div>
</body>
</html>
