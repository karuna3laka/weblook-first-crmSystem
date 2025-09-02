@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto mt-12">
        <!-- Profile Card -->
        <div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-2xl border border-gray-200/70 dark:border-gray-700/50 overflow-hidden backdrop-blur-xl">
            
            <!-- Top Section with Avatar -->
            <div class="flex flex-col items-center px-8 py-10 bg-gradient-to-b from-gray-100 to-white dark:from-neutral-800 dark:to-neutral-900">
                <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-black to-gray-600 dark:from-gray-200 dark:to-gray-500 flex items-center justify-center text-white dark:text-black text-3xl font-semibold shadow-md">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h2 class="mt-4 text-2xl font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm">{{ Auth::user()->email }}</p>
            </div>

            <!-- Info Section -->
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                <div class="px-6 py-5 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Full Name</span>
                    <span class="text-gray-900 dark:text-gray-100 font-medium">{{ Auth::user()->name }}</span>
                </div>
                <div class="px-6 py-5 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Email Address</span>
                    <span class="text-gray-900 dark:text-gray-100 font-medium">{{ Auth::user()->email }}</span>
                </div>
                <div class="px-6 py-5 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Joined On</span>
                    <span class="text-gray-900 dark:text-gray-100 font-medium">{{ Auth::user()->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
