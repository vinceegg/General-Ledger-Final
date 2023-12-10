<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href ="/css/main.css" rel ="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pamantasan ng Lungsod ng Maynila') }}
        </h2>
        @csrf 
    <div class ="dashboard-elements">
        <!-- sidebar html -->
        <div class="sidebar">
                <livewire:page-selector />
        </div>        
        <div>
            <!-- journals buttons html-->
            <div class="flex-container" style="color: rgb(246, 246, 246);">    
                <div class="container-box">          
                    <div class="horizontal-box">
                        @foreach(['CKDJ', 'CRJ', 'CDJ', 'GJ'] as $route)
                            <a href="{{ url('/' . $route) }}"  target="_blank" style="text-decoration: none;">
                                <div class="card">
                                    <h3>{{ $route }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div> <br>

                <!-- ledger sheet and reports buttons html-->
            <div class="custom-flex-container" style="color: blue;">
                <div class="custom-container-box">
                    <div class="custom-horizontal-box">
                        @foreach(['LS'] as $route)
                            <a href="{{ url('/' . $route) }}"  target="_blank" style="text-decoration: none;">
                                <div class="custom-card">
                                    <h3>{{ $route }}</h3>
                                    <!-- Add content specific to each route here if needed -->
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div> <br>
         </div>       
        </div>
    </x-slot>
</x-app-layout>
