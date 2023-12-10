<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>General Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @extends('layouts.app1')
 
    @section('content')
     
        <div>
            <livewire:general-journal-show/>

        </div>
    @section('script')
    <script>
        window.addEventListener('close-modal', event => {
     
            $('#generaljournalModal').modal('hide');
            $('#updateGeneralJournalModal').modal('hide');
            $('#deleteGeneralJournalModal').modal('hide');
            $('#softDeleteGeneralJournalModal').modal('hide');
        })
    </script>
    @endsection     
@livewireScripts
    </body>
</html>