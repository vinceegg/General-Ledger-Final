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
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>PLM | Account Codes</title>
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
            <div x-data="searchComponent()" @keydown.escape.window="search = ''; results = []" @click.away="search = ''; results = []">
                <input type="text" x-model="search" 
                       @input.debounce.300="updateResults()" @blur="search ? null : results = []" class="form-control" placeholder="Search...">
                <div x-show="results.length > 0">
                    <ul class="list-group">
                        <template x-for="item in results" :key="item.name">
                            <li class="list-group-item" @click="window.location.href = item.url">
                                <span x-text="item.name"></span>
                            </li>
                        </template>
                    </ul>
                </div>
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
                    @foreach(['LS'] as $route)
                    <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group bg-blue-700 dark:text-white dark:hover:bg-gray-700">Ledger Sheet</a>
                    @endforeach
                </li>
                <li>
                    @foreach(['AC'] as $route)
                    <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">Account Codes</a>
                    @endforeach
                </li>
            </ul>
        </li>
    </ul>
</div>
</aside>

<a href="{{ route('CashLocalTreasury') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
    Cash Local Treasury
</a>    

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('search', {
            items: [
                { name: 'Cash Receipt Journal', url: '/CRJ' },
                { name: 'Check Disbursement Journal', url: '/CKDJ' },
                { name: 'Cash Disbursement Journal', url: '/CDJ' },
                { name: 'General Journal', url: '/GJ' },
                { name: 'General Ledger', url: '/LS' },
                { name: 'Cash Local Treasury', url: '/CashLocalTreasury' },
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

<div>
    <livewire:general-ledger-show/>
  </div>

@livewireScripts
@stack('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
{{-- type ahead script --}}
<script src="https://unpkg.com/alpinejs@3.10.3" defer></script>


</body>
</html>
