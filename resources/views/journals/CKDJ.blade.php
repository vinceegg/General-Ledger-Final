<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>CKDJ</title>
    <style>
        
    </style>
    @livewireStyles
</head>
<body class="font-sans bg-gray-100">
    CKDJ (para sa ckdj)
    <livewire:page-selector />

                @extends('layouts.app1')
 
                @section('content')
                                        
                <div>
                <livewire:check-disbursement-journal-show/>
                </div>
            
            @endsection
            
            @section('script')
            <script>
                window.addEventListener('close-modal', event => {
            
                    $('#CheckDisbursementJournalModal').modal('hide');
                    $('#updateCheckDisbursementJournalModal').modal('hide');
                    $('#deleteCheckDisbursementJournalModal').modal('hide');
                    $('#softDeleteCheckDisbursementJournalModal').modal('hide');
                })
            </script>
            @endsection 

    @livewireScripts
</body>
</html>