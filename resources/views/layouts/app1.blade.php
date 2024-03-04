<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Page Title' }}</title>	
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        @livewireStyles
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="icon" href="/images/PLM-LOGO.png" type="image/x-icon">
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet" />
    </head>
    <body>
        <div id="app">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <!-- bawal mawala -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        @livewireScripts

        <!-- ADD -->
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
        <script src="../path/to/flowbite/dist/datepicker.js"></script>
    </body>
</html>