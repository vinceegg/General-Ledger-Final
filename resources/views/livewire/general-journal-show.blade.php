<div>
    @include('livewire.general-journal-modal')
         <!-- CONTENT OF PAGE -->
    
    <div class="p-4 sm:ml-64">
       <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    
       <!-- Grid wrapper -->
    <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex justify-between">
        <!-- Title -->
        <div class="flex flex-col items-left justify-between">
            <p class="font-bold text-blue-800 text-3xl">General Journal</p>
            <p class="text-yellow-600 mt-2">Journals > <span class="text-black">General Journal</span></p>
        </div>
    
            <!-- Search -->
            <div class="flex items-center">
            <input type="search" wire:model="search" wire:keydown.enter="#" class="ml-2 mr-2" placeholder="Search ID..." style="width: 180px" />
    
            <!-- Select Date -->        
            <label for="date-range" class="mb-0"></label>
    <input type="month" id="date-range" wire:model="selectedMonth" class="form-control" style="width: 150px;">
    
    
            <!-- Sort -->
            <select wire:model="sortDirection" wire:change="sortDirection" id="sortDirection" class="ml-2 mr-2">
            <option value="asc">Oldest First</option>
            <option value="desc">Newest First</option>
            </select>

            <button type="button" class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-2 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" 
            wire:click="closeModal"
            data-bs-dismiss="modal">Refresh</button> 
    
            <!-- Import -->                    
            <input type="file" wire:model="file" class="custom-file-input" id="customFile" style="width: 115px;">
            <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" wire:click="importGJ">Import</button>
    
            <!-- Export -->
            <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" wire:click="exportGJ">Export</button>
    
            <!-- Add -->
            <button type="button" class="mr-2 text-white bg-blue-800 hover:bg-blue-700  focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;"
             data-bs-toggle="modal" data-bs-target="#GeneralJournalModal">
            Add Transaction
            </button>
    
    
    
        </div>
    
    </div>
            
    <!-- Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
            <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    
    <!-- VINCEKORIN CODE -->
            <div>
        @include('livewire.cash-receipt-journal-modal')
    
                    @if (session()->has('message'))
                        <h5 class="alert alert-success">{{ session('message') }}</h5>
                    @endif
    
    
                        </div>
                            <table class="table table-borderd table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Entry Number</th>
                                        <th>Date</th>
                                        <th>Jev Number</th>
                                        <th>Particulars</th>
                                        <th>Account Code</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>General Journal Col</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($general_journal as $general_journals)
                                    <tr>
                                        
                                            <td>{{ $general_journals->id }}</td>
                                            <td>{{ $general_journals->gj_entrynum }}</td>
                                            <td>{{ $general_journals->gj_entrynum_date }}</td>
                                            <td>{{ $general_journals->gj_jevnum }}</td>
                                            <td>{{ $general_journals->gj_particulars }}</td>
                                            <td>{{ $general_journals->gj_particulars }}</td>
                                            <td>{{ $general_journals->gj_debit }}</td>
                                            <td>{{ $general_journals->gj_credit }}</td>
                                            <td>{{ $general_journals->general_journal_col }}</td>
                                        
                                        
                                            <td class="flex justify-end">
                                            <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block text-gray-500 dark:text-gray-400">
                                                <button @click="open = !open" id="dropdownButton" class="inline-block hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                                                    <span class="sr-only">Open dropdown</span>
                                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                    </svg>
                                                </button>
                                                <div x-show="open" x-transition:enter="transition-transform transition-opacity ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-transform transition-opacity ease-in duration-200 transform opacity-100 scale-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 py-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md shadow-lg z-10">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateGeneralJournalModal" wire:click="editGeneralJournal({{ $general_journals->id}})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left"> 
                                                            Edit</button>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#softDeleteGeneralJournalModal" wire:click="softDeleteGeneralJournal({{ $general_journals->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                        Archive</button>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteGeneralJournalModal" wire:click="deleteGeneralJournal({{ $general_journals->id  }})" class="block px-4 py-2 text-base text-red-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                        Delete</button>
    
                                                    
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
                        </table>
                        <button wire:click="GoToGeneralJournalTrashed" class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center">
                                View Archives
                            </button>
                        <div>
                            {{ $general_journal->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>