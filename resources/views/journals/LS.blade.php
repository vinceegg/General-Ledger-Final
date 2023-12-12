<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>LS</title>
    <style>
        
    </style>
    @livewireStyles
</head>
<body class="font-sans bg-gray-100">
    LS
    <livewire:page-selector />

                @extends('layouts.app1')
 
                @section('content')
                                        
                <div>
                <livewire:general-ledger-show/>
                </div>
            
            @endsection
            
            @section('script')
            <script>
                window.addEventListener('close-modal', event => {
            
                    $('#GeneralLedgerModal').modal('hide');
                    $('#GeneralLedgerModal').modal('hide');
                    $('#deleteGeneralLedgerModal').modal('hide');
                    $('#softDeleteGeneralLedgerModal').modal('hide');
                })
            </script>
            @endsection 

    @livewireScripts
</body>
</html>