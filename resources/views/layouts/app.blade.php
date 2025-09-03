<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Weblook CRM System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .widget-btn {
            background: linear-gradient(90deg, #000, #222 80%);
            color: #fff;
            font-size: 1.25rem;
            font-weight: 600;
            padding: 1.25rem 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px 0 rgba(0,0,0,0.18);
            transition: background 0.3s, box-shadow 0.3s;
            border: none;
            outline: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .widget-btn:hover, .widget-btn:focus {
            background: linear-gradient(90deg, #111, #333 80%);
            box-shadow: 0 8px 32px 0 rgba(0,0,0,0.28);
            color: #00ffae;
            text-decoration: none;
        }
        .widget-btn svg {
            width: 1.5rem;
            height: 1.5rem;
            fill: #fff;
            transition: fill 0.3s;
        }
        .widget-btn:hover svg {
            fill: #00ffae;
        }
    </style>
</head>
<body class="bg-white text-gray-900">
    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200 shadow-sm fixed w-full z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
                <div>
                    <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-gray-900 tracking-tight">
                        Weblook CRM 
                    </a>
                </div>

                <div class="flex space-x-6 items-center">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-black transition">
                        Dashboard
                    </a>
                    <a href="{{ route('customers.index') }}" class="text-gray-700 hover:text-black transition">
                        Customers
                    </a>
                    <a href="{{ route('invoices.index') }}" class="text-gray-700 hover:text-black transition">
                        Invoices
                    </a>
                    <a href="{{ route('proposals.index') }}" class="text-gray-700 hover:text-black transition">
                        Proposals
                    </a>

                    <a href="{{ route('profile') }}" class="text-gray-700 hover:text-black transition">
                        Profile
                    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-black hover:bg-red-900 text-white px-4 py-2 rounded-xl transition">
            Logout
        </button>
    </form>
</div>

            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 pt-24 px-6">
            <div class="max-w-3xl mx-auto text-center">

                <!-- Welcome Section -->
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    <span class="text-black">Weblook CRM System</span>
                </h1>
                
                <p class="text-lg text-gray-500">
                    A clean and modern way to manage your customers with elegance.
                </p>

                <!-- Yielded Content -->
                <div class="mt-12">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>