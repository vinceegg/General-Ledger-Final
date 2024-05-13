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
            
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" wire:model="search" wire:change="searchAction" class="w-44 ps-10 mr-2 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Search ID..." required />
                </div>

                <!-- Select Date -->        
                <label for="date-range" class="rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-0"></label>
                <input type="month" id="date-range" placeholder="Select Date" wire:model="selectedMonth" wire:change="sortDate" class="form-control rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" style="width: 170px;">

                <!-- Sort -->
                <select wire:model="sortDirection" wire:change="sortAction" id="sortBy" class="ml-2 mr-2 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="asc">Newest First</option>
                    <option value="desc">Oldest First</option>
                </select>
                
                <!-- Import -->                    
                <!-- Note: ililipat ko sa gagawin kong import modal yung choose file -mari -->
                <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" 
                data-modal-target="import-modal" data-modal-toggle="import-modal" >Import</button>

                <!-- Export -->
            
                <!-- @frontend heree need onting editing sa UI <3 -->
                <button type="button" class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;"
                data-modal-target="export-modal" data-modal-toggle="export-modal">
                    Export
                </button>

                <!-- Add -->
                <button type="button" class="mr-2 text-white bg-blue-800 hover:bg-blue-700  focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;"
                    data-modal-target="add-modal" data-modal-toggle="add-modal" >
                    Add Transaction
                </button>          
        </div>
</div>
        
<!-- 2nd Rectangle -->
<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<!-- Table -->
<div class="relative overflow-x-auto overflow-y-auto sm:rounded-lg ">
    <table class="w-full text-base text-left rtl:text-right  border-b table-auto text-gray-700 dark:text-gray-400">
        <thead class="text-base text-left text-black bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <!-- VINCEKORIN CODE -->
        <!-- Include message modal and session message -->
        @include('livewire.general-journal-modal')
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                {{ session('message') }}
            </div>
        @endif
            <tr class ="text-left bg-gray-50 shadow-md"> <!-- table heading design -->
                <th scope="col" class = "py-4 px-6">Entry Number</th>
                <th scope="col">Date</th>
                <th scope="col">Jev Number</th>
                <th scope="col">Particulars</th>
                <th scope="col">Account Code</th>
                <th scope="col">Debit</th>
                <th scope="col">Credit</th>
                <th scope="col" class="flex justify-end">
                    <div x-data="{ open: false }" @click.away="open = false" class="relative mt-3 inline-block text-gray-500 dark:text-gray-400">
                        <button @click="open = !open" id="dropdownButton" class="inline-block hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition-transform transition-opacity ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-transform transition-opacity ease-in duration-200 transform opacity-100 scale-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 py-2 
                        w-56 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md shadow-lg z-10">                         
                            <!-- Show Edit and Archive only for active records -->
                            <button type="button" wire:click="toggleDeletedView" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                                                {{ $viewDeleted ? 'Show Active Records' : 'Show Archived Records' }}
                            </button> 
                        </div>
                    </div>                 
            </tr>
        </thead>
        <tbody class="space-y-4">
            @forelse ($general_journal as $general_journals)
                @php
                    $gj_accountcodes_data = $general_journals->gj_accountcodes_data;
                    $rowSpan = count($gj_accountcodes_data) ?: 1;
                @endphp
                    @foreach ($gj_accountcodes_data as $index => $gj_accountcode_data)
                    <tr class = "hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 ">
                        @if ($index == 0)
                            <td rowspan="{{ $rowSpan }}" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $general_journals->id }}</td>
                            <td rowspan="{{ $rowSpan }}">{{ $general_journals->gj_entrynum_date }}</td>
                            <td rowspan="{{ $rowSpan }}">{{ $general_journals->gj_jevnum }}</td>
                            <td rowspan="{{ $rowSpan }}">{{ $general_journals->gj_particulars }}</td>
                        @endif
                        <td>{{ $gj_accountcode_data->gj_accountcode }}</td>
                        <td>₱{{ number_format($gj_accountcode_data->gj_debit, 2, '.', ',') }}</td>
                        <td>₱{{ number_format($gj_accountcode_data->gj_credit, 2, '.', ',') }}</td>                       
                    @endforeach
                    @if ($gj_accountcodes_data->isEmpty())
                        <tr>
                            <td>{{ $general_journals->id }}</td>
                            <td>{{ $general_journals->gj_entrynum_date }}</td>
                            <td>{{ $general_journals->gj_jevnum }}</td>
                            <td>{{ $general_journals->gj_particulars }}</td>
                            <td colspan="3">No Account Data</td>
                        </tr>
                    @endif
                        <td class="flex justify-end">
                            <div x-data="{ open: false }" @click.away="open = false" class="mt-2 relative inline-block text-gray-500 dark:text-gray-400">
                                <button @click="open = !open" id="dropdownButton" class="inline-block hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                                    <span class="sr-only">Open dropdown</span>
                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                    </svg>
                                </button>
                                <div x-show="open" x-transition:enter="transition-transform transition-opacity ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-transform transition-opacity ease-in duration-200 transform opacity-100 scale-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 py-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md shadow-lg z-10">
                                    @if (!$viewDeleted)
                                    <!-- Show Edit and Archive only for active records -->
                                    <button type="button" data-modal-target="edit-modal" data-modal-toggle="edit-modal" wire:click="editGeneralJournal({{ $general_journals->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
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
                        <td colspan="8" class="text-center">No Record Found</td>
                    </tr>
                @endforelse
        </tbody>
        <tfoot>
            <tr class="border-b shadow">
                <td colspan="5" class="px-6 py-4 text-right font-bold text-gray-900 whitespace-nowrap dark:text-white">Sub Total:</td>
                <td class="font-bold">₱{{ number_format($totalDebit, 2) }}</td>
                <td class="font-bold">₱{{ number_format($totalCredit, 2) }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>

    <!-- Pagination -->
    <div>
        {{ $general_journal->links() }}
    </div>
</div>
