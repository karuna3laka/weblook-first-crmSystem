<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-1 rounded-xl shadow-lg">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-8">
                    <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">
                        Welcome back, {{ Auth::user()->name }} 🎉
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        We're glad to see you again. Here are your account details:
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
