<x-guest-layout>
    <h1 class="text-2xl font-bold text-center mb-6">Welcome Back Again </h1>
    <p class="text-sm text-gray-400 text-center mb-8">Login to your CRM account</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input 
                id="email"
                class="block mt-1 w-full bg-neutral-800 text-white border border-neutral-700 rounded-xl focus:border-white focus:ring-white"
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input 
                id="password"
                class="block mt-1 w-full bg-neutral-800 text-white border border-neutral-700 rounded-xl focus:border-white focus:ring-white"
                type="password" 
                name="password" 
                required 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center text-gray-400">
                <input id="remember_me" type="checkbox" class="rounded bg-neutral-800 border-neutral-700 text-white focus:ring-white" name="remember">
                <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-gray-400 hover:text-white">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Button -->
        <div class="mt-6">
            <x-primary-button class="w-full bg-white text-black font-semibold rounded-xl py-3 hover:bg-gray-200 transition">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
