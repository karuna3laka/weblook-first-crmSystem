<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karunathilaka-CRM Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-black text-white flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-neutral-900 shadow-xl rounded-2xl p-8">
        {{ $slot }}
    </div>
</body>
</html>
