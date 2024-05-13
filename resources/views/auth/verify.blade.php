<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/PLM-LOGO.png" type="image/x-icon">
    <title>TWO FACTOR AUTHENTICATION | PLM General Ledger</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>
    <x-guest-layout>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
    
        {{-- <form method="POST" action="{{ route('verify.store') }}">
            @csrf
    
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="code" class="block mt-1 w-full"
                                type="text"
                                name="code"
                                required />
    
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
    
            <div class="flex justify-end mt-4">
                <x-primary-button>
                    {{ __('Confirm') }}
                </x-primary-button>
            </div>
        </form> --}}

        <div>
            <form action="" method="post" action="{{ route('verify.store') }}">
                @csrf  
                <div class="flex flex-col space-y-16">
                    <div class="flex flex-row items-center justify-between mx-auto w-full max-w-xs">
                        <div class="w-16 h-16">
                            <x-text-input id="code" class="block mt-1 w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                          type="text"
                                          name="code1"
                                          maxlength="1"
                                          required />
                        </div>
                        <div class="w-16 h-16">
                            <x-text-input id="code" class="block mt-1 w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                          type="text"
                                          name="code2"
                                          maxlength="1"
                                          required />
                        </div>
                        <div class="w-16 h-16">
                            <x-text-input id="code" class="block mt-1 w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                          type="text"
                                          name="code3"
                                          maxlength="1"
                                          required />
                        </div>
                        <div class="w-16 h-16">
                            <x-text-input id="code" class="block mt-1 w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                          type="text"
                                          name="code4"
                                          maxlength="1"
                                          required />
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('code')" class="mt-2" /> 
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button>
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <script>
            function printConcatenatedString() {
                var number1 = document.getElementById("number1").value;
                var number2 = document.getElementById("number2").value;
                var number3 = document.getElementById("number3").value;
                var number4 = document.getElementById("number4").value;
                var concatenatedString = number1 + number2 + number3 + number4;
                document.getElementById("concatenatedString").innerText = concatenatedString;
            }
            
            const inputs = document.querySelectorAll('input[type="text"]');
            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length > 0) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    }
                });
                // Prevent moving to next input field when backspacing
                input.addEventListener('keydown', (event) => {
                    if (event.key === 'Backspace' && input.value.length === 0) {
                        if (index > 0) {
                            inputs[index - 1].focus();
                        }
                    }
                });
            });
        </script>
    </x-guest-layout>
    
</body>
</html>