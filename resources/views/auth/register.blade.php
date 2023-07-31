<x-guest-layout>
    <div class="flex justify-center items-center">
        <img src="{{ asset('images/logo-text.png') }}" class="object-center hover:object-top w-auto h-32">

    </div>

    <p class="text-center text-sm text-gray-600">
        Register your account!
    </p>
    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <!-- Name -->
        <div class="flex space-x-4">
            <!-- First Name -->
            <div class="mt-4">
              <x-input-label for="first_name" :value="__('First name')" />
              <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('first_name')" class="text-xs mt-2" />
            </div>
          
            <!-- Last Name -->
            <div class="mt-4">
              <x-input-label for="name" :value="__('Last name')" />
              <x-text-input id="name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('last_name')" class="text-xs mt-2" />
            </div>
          </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="text-xs mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="text-xs mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full error"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="text-xs mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

                <hr class="my-2 border-gray-400">


        <div class="flex items-center justify-center mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
