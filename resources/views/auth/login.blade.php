<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/PLM-LOGO.png" type="image/x-icon">
    <title>LOGIN | PLM General Ledger</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>


<div class="bg-cover bg-center bg-fixed">

        <div class="rounded shadow-md w-full sm:w-none md:w-1/2 lg:w-1/3 mb-20">
        
        <x-guest-layout>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <img src="/images/PLM-Header.png">
                <h1 class="text-3xl font-bold mb-8 text-left text-blue-800"> <br>PLM Ledger <br>Sign In</h1>
                <div>
                    <x-input-label for="employee_id" :value="__('Employee ID')" />
                    <x-text-input id="employee_id" class="block w-full mt-1" type="text" name="employee_id" :value="old('employee_id')" required autofocus autocomplete="employee_id" />
                    <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block w-full mt-1"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex flex-col sm:flex-row sm:items-right sm:justify-between mt-4">
                <div class="sm:flex sm:items-right sm:justify-end">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
                <div class="flex items-center mt-4 sm:mt-0">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                    </label>
                </div>
            </div>



            
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </x-guest-layout>

</div>


</body>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</html>