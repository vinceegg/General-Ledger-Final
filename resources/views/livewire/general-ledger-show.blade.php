<div>
    <!-- CONTENT OF PAGE -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

    <!-- Grid wrapper -->
        <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex justify-between">

        <!-- Title -->
        <div class="flex flex-col items-left justify-between">
            <p class="font-bold text-blue-800 text-3xl">Ledger Sheet</p>
            <p class="text-yellow-600 mt-2"> General Ledger  <span class="text-black"General Ledger</span></p>
        </div>

        <!-- Search -->

        
        <div class="flex items-center">
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
        
<!-- Table -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
        <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

<!-- VINCEKORIN CODE -->
<div>
    @include('livewire.general-ledger-modal')
        @if (session()->has('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <table class="table table-borderd table-striped">
                    <thead>
                        <tr>
                        <th>Entry Number</th>                       
                        <th>Symbol</th>
                        <th>Name of Fund or Account</th>
                        <th>Functional Classification</th>
                        <th>Title of Project or Expense Classification</th>
                        <th>Date</th>
                        <th>Voucher No.</th>
                        <th>Particulars</th>
                        <th>Balance Debit</th>
                        <th>Debits</th>
                        <th>Credits</th>
                        <th>Credits Balance</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($general_ledger as $general_ledgers)
                    <tr>
                        <td>{{ $general_ledgers-> id }}</td>
                        
                        <td>{{ $general_ledgers-> gl_symbol}}</td>
                        <td>{{ $general_ledgers-> gl_fundname}}</td>
                        <td>{{ $general_ledgers-> gl_func_classification}}</td>
                        <td>{{ $general_ledgers-> gl_project_title}}</td>
                        <td>{{ $general_ledgers-> gl_date}}</td>
                        <td>{{ $general_ledgers-> gl_vouchernum}}</td>
                        <td>{{ $general_ledgers-> gl_particulars}}</td>
                        <td>₱{{ number_format($general_ledgers->gl_balance_debit, 2, '.', ',') }}</td>                                 
                        <td>₱{{ number_format($general_ledgers->gl_debit, 2, '.', ',') }}</td>                                 
                        <td>₱{{ number_format($general_ledgers->gl_credit, 2, '.', ',') }}</td>                      
                        <td>₱{{ number_format($general_ledgers->gl_credit_balance, 2, '.', ',') }}</td>  
                                        
                               
                        <td class="flex justify-end">
                            <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block text-gray-500 dark:text-gray-400">
                                <button @click="open = !open" id="dropdownButton" class="inline-block hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                                    <span class="sr-only">Open dropdown</span>
                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                    </svg>
                                </button>
                                <div x-show="open" x-transition:enter="transition-transform transition-opacity ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-transform transition-opacity ease-in duration-200 transform opacity-100 scale-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 py-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md shadow-lg z-10">
                                    @if (!$viewDeleted)
                                    <!-- Show Edit and Archive only for active records -->
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateGeneralLedgerModal" wire:click="editGeneralLedger({{ $general_ledgers->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                        Edit
                                    </button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#softDeleteGeneralLedgerModal" wire:click="softDeleteGeneralLedger({{ $general_ledgers->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                        Archive
                                    </button>
                                    @else
                                    <!-- Show Delete and Restore only for deleted records -->
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteGeneralLedgerModal" wire:click="deleteGeneralLedger({{ $general_ledgers->id }}, 'force')" class="block px-4 py-2 text-base text-red-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                        Delete
                                    </button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#restoreGeneralLedgerModal" wire:click="restoreGeneralLedger({{ $general_ledgers->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                        Restore
                                    </button>
                                    @endif    
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5">No Record Found</td>
                        </tr>
                    @endforelse                                
                </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8" class="text-right font-bold">Sub Total:</td>
                            <td class="font-bold">₱{{ number_format($totalBalanceDebit, 2) }}</td>
                            <td class="font-bold">₱{{ number_format($totalDebit, 2) }}</td>
                            <td class="font-bold">₱{{ number_format($totalCredit, 2) }}</td>
                            <td class="font-bold">₱{{ number_format($totalCreditBalance, 2) }}</td>
                            
                        </tr>
                    </tfoot> 
            </table>
                    
                    <div>
                        {{ $general_ledger->links() }}
                    </div>
</div>
</div>
