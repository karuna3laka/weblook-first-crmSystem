<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-300" />
            <x-text-input 
                id="name" 
                class="block mt-1 w-full bg-neutral-800 text-white border border-neutral-700 rounded-xl focus:border-white focus:ring-white"
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full bg-neutral-800 text-white border border-neutral-700 rounded-xl focus:border-white focus:ring-white"
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
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
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300" />
            <x-text-input 
                id="password_confirmation" 
                class="block mt-1 w-full bg-neutral-800 text-white border border-neutral-700 rounded-xl focus:border-white focus:ring-white"
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <!-- Register Button + Link -->
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="bg-white text-black font-semibold rounded-xl py-3 px-6 hover:bg-gray-200 transition">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
