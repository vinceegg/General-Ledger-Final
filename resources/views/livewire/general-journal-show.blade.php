
<div>

    <!-- FIRST RECTANGLE -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-none rounded-lg dark:border-gray-700 mt-14">

        <!-- Grid wrapper -->
        <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 flex justify-between">

        <!-- Title -->
        <div class="flex flex-col items-left justify-between">
            <p class="font-extrabold text-blue-800 text-3xl">General Journal</p>
            <p class="text-yellow-600 mt-2">Journals > <span class="text-black">General Journal</span></p>
        </div>

        <!-- Search -->
        <div class="flex items-center">
        <input type="search" wire:model="search" wire:change="searchAction" class="ml-2 mr-2" placeholder="Search ID..." style="width: 180px" />
    
        <!-- Select Date -->        
        <label for="date-range" class="mb-0"></label>
        <input type="month" id="date-range" wire:model="selectedMonth" wire:change="sortDate"class="form-control" style="width: 150px;">  

        <!-- Sort -->
        <select wire:model="sortDirection" wire:change="sortAction" id="sortBy" class="ml-2 mr-2">
            <option value="asc">Newest First</option>
            <option value="desc">Oldest First</option>
        </select>
        
        <!-- Import -->                    
        <input type="file" wire:model="file" class="custom-file-input" id="customFile" style="width: 115px;">
        <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" wire:click="importGJ">Import</button>

        <!-- Export -->
        <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" wire:click="exportGJ">Export</button>

        <!-- Add -->
        <button type="button" class="mr-2 text-white bg-blue-800 hover:bg-blue-700  focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;"
        data-modal-target="crud-modal" data-modal-toggle="crud-modal" >
            Add Transaction
        </button>





        {{-- View Soft Deleted Records --}}
        <button wire:click="toggleDeletedView" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ $viewDeleted ? 'Show Active Records' : 'Show Deleted Records' }}
        </button>
        
    </div>

</div>
        
<!-- 2nd Rectangle -->
<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

<!-- TABLE -->

    <div class="relative overflow-x-auto sm:rounded-lg ">
        <table class="w-full text-base text-left rtl:text-right  border-b table-auto text-gray-700 dark:text-gray-400 ">
            <thead class="text-base text-left text-black bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <!-- VINCEKORIN CODE for added successfully -->
                @include('livewire.general-journal-modal')
                    @if (session()->has('message'))
                        <h5 class="alert alert-success">{{ session('message') }}</h5>
                    @endif
                <tr class ="text-left bg-gray-50 shadow-md"> <!-- table heading design -->
                    <th scope="col" class = "py-4 px-6">ID</th>
                    <th scope="col">Entry Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Jev Number</th>
                    <th scope="col">Particulars</th>
                    <th scope="col">Account Code</th>
                    <th scope="col">Debit</th>
                    <th scope="col">Credit</th>
                    <th scope="col">General Journal Col</th>
                </tr>
            </thead>
            <tbody class="space-y-4">
                @forelse ($general_journal as $general_journals)
                            <tr class = "hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 ">
                                <td scope="row" class="px-6 py-3 font-large text-gray-900 whitespace-nowrap dark:text-white">{{ $general_journals->id }}</td>
                                <td>{{ $general_journals->gj_entrynum }}</td>
                                <td>{{ $general_journals->gj_entrynum_date }}</td>
                                <td>{{ $general_journals->gj_jevnum }}</td>
                                <td>{{ $general_journals->gj_particulars }}</td>
                                <td>{{ $general_journals->gj_accountcode }}</td>
                                <td>₱{{ number_format ($general_journals-> gj_debit, 2, '.', ',') }}</td>
                                <td>₱{{ number_format ($general_journals-> gj_credit, 2, '.', ',') }}</td>
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
                                            @if (!$viewDeleted)
                                            <!-- Show Edit and Archive only for active records -->
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateGeneralJournalModal" wire:click="editGeneralJournal({{ $general_journals->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#softDeleteGeneralJournalModal" wire:click="softDeleteGeneralJournal({{ $general_journals->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                Archive
                                            </button>
                                            @else
                                            <!-- Show Delete and Restore only for deleted records -->
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteGeneralJournalModal" wire:click="deleteGeneralJournal({{ $general_journals->id }}, 'force')" class="block px-4 py-2 text-base text-red-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                Delete
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#restoreGeneralJournalModal" wire:click="restoreGeneralJournal({{ $general_journals->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
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
                            <tr class = "border-b shadow">
                                <td colspan="6" class="px-6 py-4 font-large text-gray-900 whitespace-nowrap dark:text-white text-right font-bold">Sub Total:</td>
                                <td class="font-bold">₱{{ number_format($totalDebit, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalCredit, 2) }}</td>
                                <td></td>
                            </tr>
                            </tfoot>
                </table>
                    <div>
                        {{ $general_journal->links() }}
                    </div>
</div>




