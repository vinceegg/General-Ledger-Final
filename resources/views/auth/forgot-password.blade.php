<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/PLM-LOGO.png" type="image/x-icon">
    <title>FORGOT PASSWORD | PLM General Ledger</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>


<div class="bg-cover bg-center bg-fixed" style="background-image: url('/images/Login-Background.png')">

        <div class="rounded shadow-md w-full md:w-1/2 lg:w-1/3 mb-20">
<x-guest-layout>
<img src="/images/PLM-Header.png">
                <h1 class="text-3xl font-bold mb-8 text-left text-blue-800">  <br>Forgot Password</h1>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
