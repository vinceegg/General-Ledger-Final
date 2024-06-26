<!-- Journal Main Content Style (Padding, Margins, etc.)  -->
<div class=" p-4 sm:ml-60">
    <div class="p-4 border-2 border-gray-200 border-none rounded-lg dark:border-gray-700 mt-8">

        <!-- FIRST RECTANGLE CONTAINING TITLE, SEARCH, DATE, SORT, ETC. -->
        <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 flex flex-col md:flex-row md:items-center justify-between">
                <!-- Title -->
                <div class="flex flex-col items-left md:items-start justify-between mb-2 md:mb-0">
                    <p class="font-extrabold text-blue-800 text-3xl">Check Disbursement Journal</p>
                    <p class="text-yellow-600 mt-2">Journals > <span class="text-black">Check Disbursement Journal</span></p>
                </div>

                <!-- Functions & features in first rectangle -->
                <div class="flex flex-wrap md:justify-end">
                    <!-- Search -->
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" wire:model="search" wire:change="searchAction" class="w-44 ps-10 mr-2 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Search" required />
                    </div>    

                    <!-- Select Date -->        
                    <label for="date-range" class="rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-0"></label>
                    <input type="month" id="date-range" placeholder="Select Date" wire:model="selectedMonth" wire:change="sortDate" class="form-control rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" style="width: 170px;">

                    <!-- Sort -->
                    <select wire:model="sortDirection" wire:change="sortAction" id="sortBy" class="ml-2 mr-2 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="asc">Newest Added Entry</option>
                        <option value="desc">Oldest Added Entry</option>
                    </select>
                        
                    <!-- Import -->                    
                    <!-- Note: nilipat ko sa ginawa kong import modal yung choose file -mari -->
                    <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" 
                        data-modal-target="import-modal" data-modal-toggle="import-modal" >Import</button>

                    <!-- Export -->
                    <button type="button" class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;"
                        data-modal-target="export-modal" data-modal-toggle="export-modal">
                            Export
                    </button>

                    <!-- Add -->
                    <button type="button" wire:click="resetInput" class="mr-2 text-white bg-blue-800 hover:bg-blue-700  focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;"
                    data-modal-target="add-modal" data-modal-toggle="add-modal">
                        Add Transaction
                    </button>

                    <!-- Archive button -->
                    <a href="{{ route('CheckDisbursementJournalArchived') }}" class="relative group border border-gray-300 bg-white hover:bg-gray-200 hover:text-black rounded-lg px-3 py-2.5 text-center inline-flex items-center">
                        <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"></path>
                        </svg>
                        <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-32  bg-white border border-gray-300 text-black shadow:md text-center text-sm rounded-lg px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            View Archives
                        </div>
                    </a>
                </div>
        </div> <!-- 1st rectangle div tag -->

        <!-- 2ND RECTANGLE CONTAINING THE JOURNAL TABLE -->
        <div class="p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <!-- Table Container -->
                <div class="relative overflow-x-auto overflow-y-auto sm:rounded-lg" style="max-height:74vh">
                    <table class="w-full text-base text-left rtl:text-right table-auto text-gray-700 dark:text-gray-400">

                        <!-- Table Header -->
                        <thead class="text-base text-left shadow-md text-black sticky top-0 bg-white">
                            @include('livewire.check-disbursement-journal-modal')
                            <tr class="text-center p-1">
                                <th rowspan="3" class="border-r border-l border-b" style="width: 130px">Date</th>  
                                <th rowspan="3" class="border-r border-l border-b" style="width: 120px">Check No.</th>
                                <th rowspan="3" class="border-r border-l border-b" style="width: 200px">Jev No.</th>                          
                                <th rowspan="3" class="border-r border-l border-b" style="width: 300px">Payee</th>
                                <th rowspan="3" class="border-r border-l border-b" style="width: 150px">BUR</th>
                                <th colspan="4" class="border-r border-b border-l ">Credit</th>
                                <th colspan="2" class="border-r border-b border-l ">Debit</th>
                                <th colspan="3" class="border-b border-l ">Sundry</th>
                                <th rowspan="3" style="width: 10px"></th> <!--Ito yung header row sa rightmost para di tumagos 3dotmenu pag sinoscroll-->
                            </tr>
                            <tr class="text-center border-b">
                                <th rowspan="2" class="border-r border-l border-b" style="width: 150px">CIB-LCCA<br><span class="text-sm">1-01-02-010</span></th>
                                <th colspan="3" class="text-sm border-r border-b border-l border-t p-1">Withholding Tax</th>
                                <th rowspan="2" class="border-r border-l border-b" style="width: 120px">Sal & Wages</th>
                                <th rowspan="2" class="border-r border-l border-b" style="width: 110px">Honoraria</th>
                                <th rowspan="2" class="border-r border-l border-b" style="width: 200px">Account Code</th>
                                <th rowspan="2" class="border-r border-l border-b" style="width: 120px">Debit</th>
                                <th rowspan="2" class="border-l border-b" style="width: 120px">Credit</th>

                            </tr>
                            <tr class="text-center border-b">
                                <th class="border-r border-l text-sm" style="width: 120px">2-02-01-010-A</th>
                                <th class="border-r border-l text-sm" style="width: 120px">2-02-01-010-B</th>
                                <th class="border-r border-l text-sm" style="width: 120px">2-02-01-010-E</th>
                            </tr>
                        </thead>
                
                        <!-- Table Body -->
                        <tbody class="space-y-4  overflow-y-scroll  ">
                            @forelse ($check_disbursement_journal as $check_disbursement_journals)
                            @php
                                $ckdj_sundry_data = $check_disbursement_journals->ckdj_sundry_data; // Access the relationship
                                $rowSpan = count($ckdj_sundry_data) ?: 1; // Get count or default to 1
                                $lastRowIndex = count($ckdj_sundry_data) - 1; //for bottom border ng last row account code -mari
                            @endphp
                            @foreach ($ckdj_sundry_data as $index => $ckdj_sundries_data)
                            <tr class="{{ $index === $lastRowIndex && $ckdj_sundries_data->ckdj_credit ? 'border-b' : '' }} border-gray-300 ">
                                    @if ($index == 0) {{-- Only display these cells on the first iteration --}}
                                        <td class="border-r border-b p-2 border-gray-300" rowspan="{{ $rowSpan }}" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $check_disbursement_journals->ckdj_entrynum_date }}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">{{ $check_disbursement_journals->ckdj_checknum}}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">{{ $check_disbursement_journals->ckdj_jevnum}}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">{{ $check_disbursement_journals->ckdj_payee}}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">{{ $check_disbursement_journals->ckdj_bur}}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">₱{{ $check_disbursement_journals->ckdj_cib_lcca}}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">₱{{ $check_disbursement_journals->ckdj_account1}}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">₱{{ $check_disbursement_journals->ckdj_account2}}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">₱{{ $check_disbursement_journals->ckdj_account3}}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">₱{{ $check_disbursement_journals->ckdj_salary_wages}}</td>
                                        <td class="border-r border-b border-l p-2 border-gray-300" rowspan="{{ $rowSpan }}">₱{{ $check_disbursement_journals->ckdj_honoraria}}</td>
                                    @endif
                                    <td class="border-r border-l p-1 border-gray-300">{{ $ckdj_sundries_data->ckdj_accountcode}}</td>
                                    <td class="border-r border-l p-1 border-gray-300">₱{{ number_format($ckdj_sundries_data->ckdj_debit, 2, '.', ',') }}</td>
                                    <td class="border-l p-1 border-gray-300">₱{{ number_format($ckdj_sundries_data->ckdj_credit, 2, '.', ',') }}</td>
                            @endforeach
                            @if ($ckdj_sundry_data->isEmpty()) {{-- If there are no account codes, show a single row --}}
                                    <td class="border-r border-b p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_entrynum_date }}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_checknum}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_jevnum}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_payee}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_bur}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_cib_lcca}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_account1}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_account2}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_account3}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_salary_wages}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $check_disbursement_journals->ckdj_honoraria}}</td>
                                    <td class="border-l border-b p-1 border-gray-300" colspan="3">No Account Data</td>
                            @endif
                            <td class="justify-end">
                                            <div x-data="{ open: false }" @click.away="open = false" class="mt-1 inline-block text-gray-500 dark:text-gray-400">
                                                <button @click="open = !open" id="dropdownButton" class="inline-block  focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                                                    <span class="sr-only">Open dropdown</span>
                                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                    </svg>
                                                </button>
                                                <div x-show="open" x-transition:enter="transition-transform transition-opacity ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-transform transition-opacity ease-in duration-200 transform opacity-100 scale-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 py-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md shadow-lg z-10">
                                                    <!-- Show Edit and Archive only for active records -->
                                                    
                                                    <button type="button" wire:click="softDeleteCheckDisbursementJournal('{{  $check_disbursement_journals->checkdisbursementjournal_no }}')" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                            Archive
                                                    </button>                                                                                    
                                                </div>
                                            </div>
                                        </td> 
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="padding-top: 24px; padding-bottom: 24px;" class="p-2">No record found.</td>
                                    </tr>
                            @endforelse
                        </tbody>

                        <!-- Table Footer -->
                        <tfoot>
                            <!-- Subtotal -->
                            <tr class="border-t shadow-inner  sticky bottom-0 bg-white">
                                <td colspan="5" class="px-6 py-4 text-right font-bold text-gray-900 whitespace-nowrap dark:text-white">Sub Total:</td>
                                <td class="font-bold">₱{{ number_format($totalCib, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalAccount1, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalAccount2, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalAccount3, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalSalaryWages, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalHonoraria, 2) }}</td>
                                <!-- <td class="font-bold">₱{{ number_format($totalAccountCode, 2) }}</td> -->
                                <td></td>
                                <td class="font-bold">₱{{ number_format($totalDebit, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalCredit, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>                   
                </div>   <!-- table container div tag -->             
        </div> <!-- 2nd rectangle div tag -->
        
    </div> <!-- journal main content div tag 2 -->
</div> <!-- journal main content div tag 1 -->