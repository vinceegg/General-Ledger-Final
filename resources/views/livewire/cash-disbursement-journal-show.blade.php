<div>
    <!-- CONTENT OF PAGE -->
    <div class="p-4 sm:ml-64">
       <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    
    <!-- Grid wrapper -->
    <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex justify-between">
        
        <!-- Title -->
        <div class="flex flex-col items-left justify-between">
            <p class="font-bold text-blue-800 text-3xl">Cash Disbursement Journal</p>
            <p class="text-yellow-600 mt-2">Journals > <span class="text-black">Cash Disbursement Journal</span></p>
        </div>
    
        <!-- Search -->
        <div class="flex items-center">
        <input type="search" wire:model="search" wire:change="searchAction" class="ml-2 mr-2" placeholder="Search ID..." style="width: 180px" />
    
        <!-- Select Date -->        
        <label for="date-range" class="mb-0"></label>
        <input type="month" id="date-range" wire:model="selectedMonth" wire:change="sortDate" class="form-control" style="width: 150px;">
    
    
        <!-- Sort -->
        <select wire:model="sortDirection" wire:change="sortAction" id="sortDirection" class="ml-2 mr-2">
        <option value="asc">Oldest First</option>
        <option value="desc">Newest First</option>
        </select>
    
        <button type="button" class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-2 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" 
        wire:click="closeModal"
        data-bs-dismiss="modal">Refresh</button> 
            
        <!-- Import -->                    
        <input type="file" wire:model="file" class="custom-file-input" id="customFile" style="width: 115px;">
        <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" wire:click="importCDJ">Import</button>
    
        <!-- Export -->
        <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" wire:click="exportCDJ">Export</button>
    
        <!-- Add -->
        <button type="button" class="mr-2 text-white bg-blue-800 hover:bg-blue-700  focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;"
        data-bs-toggle="modal" data-bs-target="#CashDisbursementJournalModal">
        Add Transaction
        </button>

        <button wire:click="toggleDeletedView" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ $viewDeleted ? 'Show Active Records' : 'Show Deleted Records' }}
        </button>
    
    </div>
    
 </div>
            
    <!-- Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
            <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    
    <!-- VINCEKORIN CODE -->
            <div>
        @include('livewire.cash-disbursement-journal-modal')
            @if (session()->has('message'))
                 <h5 class="alert alert-success">{{ session('message') }}</h5>
            @endif
                <table class="table table-borderd table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Entry Number</th>
                            <th>Date</th>
                            <th>Reference/RD No.</th>
                            <th>Accountable Officer</th>
                            <th>JEV No.</th>
                            <th>Account Code</th>
                            <th>Amount</th>
                            <th>5-02-99-990</th>
                            <th>5-02-02-010</th>
                            <th>Account Code</th>
                            <th>PR</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse ($cash_disbursement_journal as $cash_disbursement_journals)
                            <tr>
                                <td>{{ $cash_disbursement_journals-> id }}</td>
                                <td>{{ $cash_disbursement_journals-> cdj_entrynum }}</td>
                                <td>{{ $cash_disbursement_journals-> cdj_entrynum_date }}</td>
                                <td>{{ $cash_disbursement_journals-> cdj_referencenum }}</td>
                                <td>{{ $cash_disbursement_journals-> cdj_accountable_officer}}</td>
                                <td>{{ $cash_disbursement_journals-> cdj_jevnum }}</td>
                                <td>{{ $cash_disbursement_journals-> cdj_accountcode }}</td>
                                <td>₱{{ number_format ($cash_disbursement_journals-> cdj_amount, 2, '.', ',') }}</td>                              
                                <td>₱{{ number_format ($cash_disbursement_journals-> cdj_account1, 2, '.', ',') }}</td>                   
                                <td>₱{{ number_format ($cash_disbursement_journals-> cdj_account2, 2, '.', ',') }}</td>
                                <td>{{ $cash_disbursement_journals-> cdj_sundry_accountcode }}</td>
                                <td>{{ $cash_disbursement_journals-> cdj_pr }}</td>
                                <td>₱{{ number_format ($cash_disbursement_journals-> cdj_debit, 2, '.', ',') }}</td>
                                <td>₱{{ number_format ($cash_disbursement_journals-> cdj_credit, 2, '.', ',') }}</td>
    
    
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
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateCashDisbursementJournalModal" wire:click="editCashDisbursementJournal({{ $cash_disbursement_journals->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                        Edit
                                                    </button>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#softDeleteCashDisbursementJournalModal" wire:click="softDeleteCashDisbursementJournal({{ $cash_disbursement_journals->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                        Archive
                                                    </button>
                                                    @else
                                                    <!-- Show Delete and Restore only for deleted records -->
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteCashDisbursementJournalModal" wire:click="deleteCashDisbursementJournal({{ $cash_disbursement_journals->id }}, 'force')" class="block px-4 py-2 text-base text-red-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                        Delete
                                                    </button>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#restoreCashDisbursementJournalModal" wire:click="restoreCashDisbursementJournal({{ $cash_disbursement_journals->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
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
                                    <td></td>
                                    <td colspan="6" class="text-right font-bold">Sub Total:</td>
                                    <td class="font-bold">₱{{ number_format($totalAmount, 2) }}</td>
                                    <td class="font-bold">₱{{ number_format($totalAccount1, 2) }}</td>
                                    <td class="font-bold">₱{{ number_format($totalAccount2, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td class="font-bold">₱{{ number_format($totalDebit, 2) }}</td>
                                    <td class="font-bold">₱{{ number_format($totalCredit, 2) }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                    </table>
                        <div>
                            {{ $cash_disbursement_journal->links() }}
                        </div>
</div>