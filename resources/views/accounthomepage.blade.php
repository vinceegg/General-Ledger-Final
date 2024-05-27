<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="/css/main.css" rel="stylesheet">
    <link rel="icon" href="/images/PLM-LOGO.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>PLM | Ledger Sheets</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>
@csrf
<!-- TOPNAV -->
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                @foreach([''] as $route) {{ $route }}
                <a href="{{ url('/dashboard' . $route) }}" class="flex ms-2 md:me-24">
                    <img src="/images/PLM-LOGO.png" class="h-8 me-3" alt="FlowBite Logo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-blue-800">PLM LEDGER</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</nav>
      
<!-- SIDEBAR -->
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-blue-800 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-800 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                @foreach([''] as $route) 
                <a href="{{ url('/dashboard' . $route) }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-blue-900 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8v10a1 1 0 0 0 1 1h4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5h4a1 1 0 0 0 1-1V8M1 10l9-9 9 9"/>
                    </svg>
                    <span class="ms-3">Home</span>
                </a>
                @endforeach
            </li>
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M17 10H4a1 1 0 0 0-1 1v9m14-10a1 1 0 0 1 1 1m-1-1h-5.057M17 10a1 1 0 0 1 1 1m0 0v9m0 0a1 1 0 0 1-1 1m1-1a1 1 0 0 1-1 1m0 0H4m0 0a1 1 0 0 1-1-1m1 1a1 1 0 0 1-1-1m0 0V7m0 0a1 1 0 0 1 1-1h4.443a1 1 0 0 1 .8.4l2.7 3.6M3 7v3h8.943M18 18h2a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-5.057l-2.7-3.6a1 1 0 0 0-.8-.4H7a1 1 0 0 0-1 1v1"/>
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Journals</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="dropdown-example" class="py-2 space-y-2">
                    <li>
                        @foreach(['CKDJ'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">Check Disbursements</a>
                        @endforeach
                    </li>
                    <li>
                        @foreach(['CDJ'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">Cash Disbursements</a>
                        @endforeach
                    </li>
                    <li>
                        @foreach(['CRJ'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">Cash Receipt</a>
                        @endforeach
                    </li>
                    <li>
                        @foreach(['GJ'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">General Journal</a>
                        @endforeach
                    </li>
                </ul>
            </li>
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">
                    <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M17 10H4a1 1 0 0 0-1 1v9m14-10a1 1 0 0 1 1 1m-1-1h-5.057M17 10a1 1 0 0 1 1 1m0 0v9m0 0a1 1 0 0 1-1 1m1-1a1 1 0 0 1-1 1m0 0H4m0 0a1 1 0 0 1-1-1m1 1a1 1 0 0 1-1-1m0 0V7m0 0a1 1 0 0 1 1-1h4.443a1 1 0 0 1 .8.4l2.7 3.6M3 7v3h8.943M18 18h2a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-5.057l-2.7-3.6a1 1 0 0 0-.8-.4H7 a1 1 0 0 0-1 1v1"/>
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">General Ledger</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="dropdown-example2" class="py-2 space-y-2">
                    <li>
                        @foreach(['AC'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group bg-blue-700 dark:text-white dark:hover:bg-gray-700">Ledger Sheets</a>
                        @endforeach
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <ul class="fixed bottom-0 pb-10 left-2 w-56 pt-4 mt-4 space-y-2 font-small border-t border-gray-200 dark:border-gray-700">
        <li>
            @foreach([''] as $route) {{ $route }}
            <a href="{{ url('/faqs' . $route) }}" class="flex items-center p-2 text-white transition duration-75 rounded-lg hover:bg-blue-900 dark:hover:bg-gray-700 dark:text-white group">
                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.529 7.988a2.502 2.502 0 0 1 5 .191A2.441 2.441 0 0 1 10 10.582V12m-.01 3.008H10M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <span class="ms-3">Help / FAQ</span>
            </a>
            @endforeach
        </li>
        <li>
        </li>    
    </ul>     
  </div>
</aside>

<div>
    <!-- CONTENT OF PAGE -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <!-- Grid wrapper -->
            <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex justify-between">
                <div class="grid grid-cols-3 gap-4">
                    <div class="...">
                        <!-- Title -->
                        <div class="flex flex-col items-left justify-between">
                            <p class="font-bold text-blue-800 text-3xl">Ledger Sheet</p>
                            <p class="text-yellow-600 mt-2"> General Ledger  <span class="text-black">> Ledger Sheet</span></p>
                        </div>
                    </div>
                    <div class="col-span-2  items-center ml-10">
                    {{-- search bar --}}
                        <div x-data="searchComponent()" @keydown.escape.window="search = ''; results = []" @click.away="search = ''; results = []" class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" x-model="search" @input.debounce.300="updateResults()" @blur="search ? null : results = []" class="block w-full p-5 ps-10 text-sm text-gray-1000 border-none rounded-xl bg-gray-200 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
                            <div x-show="results.length > 0" class="absolute z-10 mt-1 bg-white border border-gray-300 rounded w-full">
                                <ul class="divide-y divide-gray-300">
                                    <template x-for="item in results" :key="item.name">
                                        <li class="px-4 py-2 cursor-pointer hover:bg-gray-100" @click="window.location.href = item.url">
                                            <span x-text="item.name"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Action
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Account Code
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        New Account Titles
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('LS') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a>  
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 01 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        Cash Local Treasury
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('PettyCash') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 01 01 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    Petty Cash
                    </td>
                </tr>

                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('CashinBankLocalCurrencyCurrentAccount') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 01 02 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    Cash in Bank Local Currency Current Account
                    </td>
                </tr>

                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('CashinBankLocalCurrencyTimeDeposits') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 02 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    Cash in Bank Local Currency Time Deposits
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccountsReceivable') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 03 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    Accounts Receivable
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('InterestsReceivable') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 03 01 070
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    Interests Receivable
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OfficeEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    Office Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccumulatedDepreciationOfficeEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 021
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    Accumulated Depreciation Office Equipment
                    </td>
                </tr>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('InfoandCommunicationTechnologyEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 030
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    Info and Communication Technology Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccumulatedDepreciationICTEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 031
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Accumulated Depreciation ICT Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DisasterResponseandRescueEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 090
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Disaster Response and Rescue Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccDepreciationDisasterResponseandRescueEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 091
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Acc Depreciation Disaster Response and Rescue Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('MilitaryPoliceSecurityEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 100
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Military Police Security Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccDepreciationMilitaryPoliceSecurityEqpmnt') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 101
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Acc Depreciation Military Police Security Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('MedicalEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 110
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Medical Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccumulatedDepreciationMedicalEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 111
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Accumulated Depreciation Medical Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('SportsEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 130
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Sports Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccumulatedDepreciationSportsEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 131
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Accumulated Depreciation Sports Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('TechnicalandScientificEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 140
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Technical and Scientific Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccDepreciationTechnicalScientificEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 141
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Acc Depreciation Technical Scientific Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OtherMachineryEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 990
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Other Machinery Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccDepreciationOtherMachineryEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 05 991
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Acc Depreciation Other Machinery Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('GrantsDonationsinKind') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    4 04 02 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Grants Donations in Kind
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('MiscellaneousIncome') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    4 06 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Miscellaneous Income
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('SalariesandWagesRegular') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Salaries and Wages Regular
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('SalariesandWagesCasualContractual') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 01 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Salaries and Wages Casual Contractual
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('PersonnelEconomicReliefAllowance') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Personnel Economic Relief Allowance
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('RepresentationAllowance') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Representation Allowance
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('TransportationAllowance') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 030
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Transportation Allowance
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('ClothingUniformAllowance') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 040
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Clothing Uniform Allowance
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('Honoraria') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 100
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Honoraria
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('HazardPay') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 110
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Hazard Pay
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('LongetivityPay') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 120
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Longetivity Pay
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OvertimeandNightPay') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 130
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Overtime and Night Pay
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('YearEndBonus') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 140
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Year End Bonus
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('CashGift') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 02 150
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Cash Gift
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('RetirementandLifeInsurancePremiums') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 03 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Retirement and Life Insurance Premiums
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('PagibigContributions') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 03 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Pag ibig Contributions
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('PhilHealthContributions') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 03 030
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   PhilHealth Contributions
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('EmployeesCompensationInsurancePremiums') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 03 040
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Employees Compensation Insurance Premiums
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('TerminalLeaveBenefits') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 04 030
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Terminal Leave Benefits
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OtherPersonnelBenefits') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 01 04 990
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Other Personnel Benefits
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('TravelingExpensesLocal') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Traveling Expenses Local
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('TrainingExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 02 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Training Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OfficeSuppliesExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 03 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Office Supplies Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccountableFormsExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 03 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Accountable Forms Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DrugsandMedicinesExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 03 070
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Drugs and Medicines Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('MedicalDentalandLaboratorySuppliesExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 03 080
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Medical Dental and Laboratory Supplies Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('FuelOilandLubricantsExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 03 090
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Fuel Oil and Lubricants Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OtherSuppliesandMaterialsExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 03 990
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Other Supplies and Materials Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('WaterExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 04 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Water Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('ElectricityExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 04 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Electricity Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('PostageandCourierServices') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 05 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Postage and Courier Services
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('TelephoneExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 05 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Telephone Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('InternetSubscriptionExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 05 030
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Internet Subscription Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('ExtraordinaryandMiscellaneousExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 10 030
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Extraordinary and Miscellaneous Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('MotorVehicles') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 06 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Motor Vehicles
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccumulatedDepreciationMotorVehicles') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 06 011
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Accumulated Depreciation Motor Vehicles
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('FurnitureandFixtures') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 07 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Furniture and Fixtures
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccumulatedDepreciationFurnitureandFixtures') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 07 011
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Accumulated Depreciation Furniture and Fixtures
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('BuildingsandOtherStructures') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    1 07 10 030
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Buildings and Other Structures
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AccountsPayable') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 01 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Accounts Payable
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DuetoOfficersandEmployees') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 01 01 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Due to Officers and Employees
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DuetoBIR') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 02 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Due to BIR
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DuetoGSIS') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 02 01 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Due to GSIS
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DuetoPAGIBIG') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 02 01 030
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Due to PAG IBIG
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DuetoPHILHEALTH') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 02 01 040
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Due to PHILHEALTH
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('TrustLiabilities') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 04 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Trust Liabilities
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('GuarantySecurityDepositsPayable') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 04 01 050
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Guaranty Security Deposits Payable
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('CustomersDeposit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 04 01 050
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Customers Deposit
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OtherDeferredCredits') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 05 01 990
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Other Deferred Credits
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OtherPayables') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    2 99 99 990
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Other Payables
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('GovernmentEquity') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    3 01 01 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Government Equity
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('PriorPeriodAdjustment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    3 01 01 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Prior Period Adjustment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('FinesandPenaltiesServiceIncome') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    4 02 01 980
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Fines and Penalties Service Income
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('SchoolFees') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    4 02 02 010
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   School Fees
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('AffiliationFees') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    4 02 02 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Affiliation Fees
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('RentIncome') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    4 02 02 050
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Rent Income
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('InterestIncome') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    4 02 02 220
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Interest Income
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OtherBusinessIncome') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    4 02 02 990
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Other Business Income
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('SubsidyfromLGUs') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    4 03 01 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Subsidy from LGUs
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OtherProfessionalServices') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 11 990
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Other Professional Services
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('RepairsandMaintBuildingOtherStructures') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 13 040
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Repairs and Maint Building Other Structures
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('RepairsandMaintMachineryandEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 13 050
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Repairs and Maint Machinery and Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('RepairsandMaintTransportationEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 13 060
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Repairs and Maint Transportation Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('FidelityBondPremiums') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 16 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Fidelity Bond Premiums
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('InsuranceExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 16 030                
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Insurance Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('PrintingandPublicationExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 99 020
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Printing and Publication Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('RepresentationExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 99 030
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Representation Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('RentExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 99 050
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Rent Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('MembershipDuesandContributiontoOrg') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 99 060
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Membership Dues and Contribution to Org
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('SubscriptionExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 99 070
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Subscription Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('OtherMaintenanceandOperatingExpenses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 02 99 990
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Other Maintenance and Operating Expenses
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('BankCharges') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 03 01 040
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Bank Charges
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DepreciationBuildingandStructures') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 05 01 040
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Depreciation  Building and Structures
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DepreciationMachineryandEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 05 01 050
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Depreciation  Machinery and Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DepreciationTransportationEquipment') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 05 01 060
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Depreciation  Transportation Equipment
                    </td>
                </tr>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('DepreciationFurnituresandBooks') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            View
                        </a> 
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    5 05 01 070
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                   Depreciation  Furnitures and Books
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- SEARCH -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('search', {
            items: [
                // format: { name: '1 01 01 010 | Cash Local Treasury', url: '/LS' },
                {name:'1 01 01 010 - Cash Local Treasury',url:'/LS'},
                {name:'1 01 01 020 - Petty Cash',url:'/PettyCash'},
                {name:'1 01 02 010 - Cash in Bank Local Currency Current Account',url:'/CashinBankLocalCurrencyCurrentAccount'},
                {name:'1 02 01 010 - Cash in Bank Local Currency Time Deposits',url:'/CashinBankLocalCurrencyTimeDeposits'},
                {name:'1 03 01 010 - Accounts Receivable',url:'/AccountsReceivable'},
                {name:'1 03 01 070 - Interests Receivable',url:'/InterestsReceivable'},
                {name:'1 07 05 020 - Office Equipment',url:'/OfficeEquipment'},
                {name:'1 07 05 021 - Accumulated Depreciation Office Equipment',url:'/AccumulatedDepreciationOfficeEquipment'},
                {name:'1 07 05 030 - Info and Communication Technology Equipment',url:'/InfoandCommunicationTechnologyEquipment'},
                {name:'1 07 05 031 - Accumulated Depreciation ICT Equipment',url:'/AccumulatedDepreciationICTEquipment'},
                {name:'1 07 05 090 - Disaster Response and Rescue Equipment',url:'/DisasterResponseandRescueEquipment'},
                {name:'1 07 05 091 - Acc Depreciation Disaster Response and Rescue Equipment',url:'/AccDepreciationDisasterResponseandRescueEquipment'},
                {name:'1 07 05 100 - Military Police Security Equipment',url:'/MilitaryPoliceSecurityEquipment'},
                {name:'1 07 05 101 - Acc Depreciation Military Police Security Eqpmnt',url:'/AccDepreciationMilitaryPoliceSecurityEqpmnt'},
                {name:'1 07 05 110 - Medical Equipment',url:'/MedicalEquipment'},
                {name:'1 07 05 111 - Accumulated Depreciation Medical Equipment',url:'/AccumulatedDepreciationMedicalEquipment'},
                {name:'1 07 05 130 - Sports Equipment',url:'/SportsEquipment'},
                {name:'1 07 05 131 - Accumulated Depreciation Sports Equipment',url:'/AccumulatedDepreciationSportsEquipment'},
                {name:'1 07 05 140 - Technical and Scientific Equipment',url:'/TechnicalandScientificEquipment'},
                {name:'1 07 05 141 - Acc Depreciation Technical Scientific Equipment',url:'/AccDepreciationTechnicalScientificEquipment'},
                {name:'1 07 05 990 - Other Machinery Equipment',url:'/OtherMachineryEquipment'},
                {name:'1 07 05 991 - Acc Depreciation Other Machinery Equipment',url:'/AccDepreciationOtherMachineryEquipment'},
                {name:'4 04 02 020 - Grants Donations in Kind',url:'/GrantsDonationsinKind'},
                {name:'4 06 01 010 - Miscellaneous Income',url:'/MiscellaneousIncome'},
                {name:'5 01 01 010 - Salaries and Wages Regular',url:'/SalariesandWagesRegular'},
                {name:'5 01 01 020 - Salaries and Wages Casual Contractual',url:'/SalariesandWagesCasualContractual'},
                {name:'5 01 02 010 - Personnel Economic Relief Allowance',url:'/PersonnelEconomicReliefAllowance'},
                {name:'5 01 02 020 - Representation Allowance',url:'/RepresentationAllowance'},
                {name:'5 01 02 030 - Transportation Allowance',url:'/TransportationAllowance'},
                {name:'5 01 02 040 - Clothing Uniform Allowance',url:'/ClothingUniformAllowance'},
                {name:'5 01 02 100 - Honoraria',url:'/Honoraria'},
                {name:'5 01 02 110 - Hazard Pay',url:'/HazardPay'},
                {name:'5 01 02 120 - Longetivity Pay',url:'/LongetivityPay'},
                {name:'5 01 02 130 - Overtime and Night Pay',url:'/OvertimeandNightPay'},
                {name:'5 01 02 140 - Year End Bonus',url:'/YearEndBonus'},
                {name:'5 01 02 150 - Cash Gift',url:'/CashGift'},
                {name:'5 01 03 010 - Retirement and Life Insurance Premiums',url:'/RetirementandLifeInsurancePremiums'},
                {name:'5 01 03 020 - Pag ibig Contributions',url:'/PagibigContributions'},
                {name:'5 01 03 030 - PhilHealth Contributions',url:'/PhilHealthContributions'},
                {name:'5 01 03 040 - Employees Compensation Insurance Premiums',url:'/EmployeesCompensationInsurancePremiums'},
                {name:'5 01 04 030 - Terminal Leave Benefits',url:'/TerminalLeaveBenefits'},
                {name:'5 01 04 990 - Other Personnel Benefits',url:'/OtherPersonnelBenefits'},
                {name:'5 02 01 010 - Traveling Expenses Local',url:'/TravelingExpensesLocal'},
                {name:'5 02 02 010 - Training Expenses',url:'/TrainingExpenses'},
                {name:'5 02 03 010 - Office Supplies Expenses',url:'/OfficeSuppliesExpenses'},
                {name:'5 02 03 020 - Accountable Forms Expenses',url:'/AccountableFormsExpenses'},
                {name:'5 02 03 070 - Drugs and Medicines Expenses',url:'/DrugsandMedicinesExpenses'},
                {name:'5 02 03 080 - Medical Dental and Laboratory Supplies Expenses',url:'/MedicalDentalandLaboratorySuppliesExpenses'},
                {name:'5 02 03 090 - Fuel Oil and Lubricants Expenses',url:'/FuelOilandLubricantsExpenses'},
                {name:'5 02 03 990 - Other Supplies and Materials Expenses',url:'/OtherSuppliesandMaterialsExpenses'},
                {name:'5 02 04 010 - Water Expenses',url:'/WaterExpenses'},
                {name:'5 02 04 020 - Electricity Expenses',url:'/ElectricityExpenses'},
                {name:'5 02 05 010 - Postage and Courier Services',url:'/PostageandCourierServices'},
                {name:'5 02 05 020 - Telephone Expenses',url:'/TelephoneExpenses'},
                {name:'5 02 05 030 - Internet Subscription Expenses',url:'/InternetSubscriptionExpenses'},
                {name:'5 02 10 030 - Extraordinary and Miscellaneous Expenses',url:'/ExtraordinaryandMiscellaneousExpenses'},
                {name:'1 07 06 010 - Motor Vehicles',url:'/MotorVehicles'},
                {name:'1 07 06 011 - Accumulated Depreciation Motor Vehicles',url:'/AccumulatedDepreciationMotorVehicles'},
                {name:'1 07 07 010 - Furniture and Fixtures',url:'/FurnitureandFixtures'},
                {name:'1 07 07 011 - Accumulated Depreciation Furniture and Fixtures',url:'/AccumulatedDepreciationFurnitureandFixtures'},
                {name:'1 07 10 030 - Buildings and Other Structures',url:'/BuildingsandOtherStructures'},
                {name:'2 01 01 010 - Accounts Payable',url:'/AccountsPayable'},
                {name:'2 01 01 020 - Due to Officers and Employees',url:'/DuetoOfficersandEmployees'},
                {name:'2 02 01 010 - Due to BIR',url:'/DuetoBIR'},
                {name:'2 02 01 020 - Due to GSIS',url:'/DuetoGSIS'},
                {name:'2 02 01 030 - Due to PAG IBIG',url:'/DuetoPAGIBIG'},
                {name:'2 02 01 040 - Due to PHILHEALTH',url:'/DuetoPHILHEALTH'},
                {name:'2 04 01 010 - Trust Liabilities',url:'/TrustLiabilities'},
                {name:'2 04 01 050 - Guaranty Security Deposits Payable',url:'/GuarantySecurityDepositsPayable'},
                {name:'2 04 01 050 - Customers Deposit',url:'/CustomersDeposit'},
                {name:'2 05 01 990 - Other Deferred Credits',url:'/OtherDeferredCredits'},
                {name:'2 99 99 990 - Other Payables',url:'/OtherPayables'},
                {name:'3 01 01 010 - Government Equity',url:'/GovernmentEquity'},
                {name:'3 01 01 020 - Prior Period Adjustment',url:'/PriorPeriodAdjustment'},
                {name:'4 02 01 980 - Fines and Penalties Service Income',url:'/FinesandPenaltiesServiceIncome'},
                {name:'4 02 02 010 - School Fees',url:'/SchoolFees'},
                {name:'4 02 02 020 - Affiliation Fees',url:'/AffiliationFees'},
                {name:'4 02 02 050 - Rent Income',url:'/RentIncome'},
                {name:'4 02 02 220 - Interest Income',url:'/InterestIncome'},
                {name:'4 02 02 990 - Other Business Income',url:'/OtherBusinessIncome'},
                {name:'4 03 01 020 - Subsidy from LGUs',url:'/SubsidyfromLGUs'},
                {name:'5 02 11 990 - Other Professional Services',url:'/OtherProfessionalServices'},
                {name:'5 02 13 040 - Repairs and Maint Building Other Structures',url:'/RepairsandMaintBuildingOtherStructures'},
                {name:'5 02 13 050 - Repairs and Maint Machinery and Equipment',url:'/RepairsandMaintMachineryandEquipment'},
                {name:'5 02 13 060 - Repairs and Maint Transportation Equipment',url:'/RepairsandMaintTransportationEquipment'},
                {name:'5 02 16 020 - Fidelity Bond Premiums',url:'/FidelityBondPremiums'},
                {name:'5 02 16 030 - Insurance Expenses',url:'/InsuranceExpenses'},
                {name:'5 02 99 020 - Printing and Publication Expenses',url:'/PrintingandPublicationExpenses'},
                {name:'5 02 99 030 - Representation Expenses',url:'/RepresentationExpenses'},
                {name:'5 02 99 050 - Rent Expenses',url:'/RentExpenses'},
                {name:'5 02 99 060 - Membership Dues and Contribution to Org',url:'/MembershipDuesandContributiontoOrg'},
                {name:'5 02 99 070 - Subscription Expenses',url:'/SubscriptionExpenses'},
                {name:'5 02 99 990 - Other Maintenance and Operating Expenses',url:'/OtherMaintenanceandOperatingExpenses'},
                {name:'5 03 01 040 - Bank Charges',url:'/BankCharges'},
                {name:'5 05 01 040 - Depreciation  Building and Structures',url:'/DepreciationBuildingandStructures'},
                {name:'5 05 01 050 - Depreciation  Machinery and Equipment',url:'/DepreciationMachineryandEquipment'},
                {name:'5 05 01 060 - Depreciation  Transportation Equipment',url:'/DepreciationTransportationEquipment'},
                {name:'5 05 01 070 - Depreciation  Furnitures and Books',url:'/DepreciationFurnituresandBooks'},   
            ],
            updateResults() {
                const search = this.search.trim().toLowerCase();
                if (search) {
                    this.results = this.items.filter(item => 
                        item.name.toLowerCase().includes(search)
                    );
                } else {
                    this.results = [];
                }
            }
        });

        Alpine.data('searchComponent', function () {
            return {
                search: '',
                results: [],
                updateResults() {
                    this.results = Alpine.store('search').items.filter(item =>
                        item.name.toLowerCase().includes(this.search.trim().toLowerCase())
                    );
                },
                init() {
                    this.$watch('search', (value) => {
                        if (value) {
                            this.updateResults();
                        } else {
                            this.results = [];
                        }
                    });
                }
            };
        });
    });
</script>

@livewireScripts
@stack('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
{{-- type ahead script --}}
<script src="https://unpkg.com/alpinejs@3.10.3" defer></script>

</body>
</html>