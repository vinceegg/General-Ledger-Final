<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/PLM-LOGO.png" type="image/x-icon">
    <title>RESET PASSWORD | PLM General Ledger</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>


<div class="bg-cover bg-center bg-fixed" style="background-image: url('/images/Login-Background.png')">

        <div class="rounded shadow-md w-full md:w-1/2 lg:w-1/3 mb-20">
<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <img src="/images/PLM-Header.png">
                <h1 class="text-3xl font-bold mb-8 text-left text-blue-800"> <br>PLM Ledger <br>Reset Password</h1>
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
