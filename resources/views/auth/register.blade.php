<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/PLM-LOGO.png" type="image/x-icon">
    <title>REGISTER | PLM General Ledger</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>
        <div class="rounded shadow-md h -full w-full md:w-1/2 lg:w-1/3 mb-20">
            <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <img src="/images/PLM-Header.png">
                <h1 class="text-3xl font-bold mb-8 text-left text-blue-800"> <br>PLM Ledger <br>Register</h1>
        <!-- Name -->
        <div>
            <x-input-label for="employee_id" :value="__('Employee ID')" />
            <x-text-input id="employee_id" class="block w-full mt-1" type="text" name="employee_id" :value="old('employee_id')" required autofocus autocomplete="employee_id" />
            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>

            
        </div>
    </form>
</div>
</x-guest-layout>
