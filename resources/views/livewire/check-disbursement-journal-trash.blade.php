<!-- Journal Main Content Style (Padding, Margins, etc.)  -->
<div wire:ignore class=" p-4 sm:ml-60">
    <div class="p-4 border-2 border-gray-200 border-none rounded-lg dark:border-gray-700 mt-8">

        <!-- FIRST RECTANGLE CONTAINING TITLE, SEARCH, DATE, SORT, ETC. -->
        <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 flex flex-col md:flex-row md:items-center justify-between">
            <!-- Title -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between w-full">
                <p class="font-bold text-gray-800 text-xl">Archived Records of Check Disbursement Journal</p>
                
                <!-- SVG Icon and Link -->
                <div class="flex items-center mt-4 md:mt-0">

                    <a href="{{ route('CKDJ') }}" class="btn flex btn-primary text-blue-800 font-semibold">
                    <svg class="w-5 h-5 mr-2" data-slot="icon" fill="none" stroke-width="1.8" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0L9 3M3 9h12a6 6 0 0 1 0 12h-3"></path>
                    </svg>
                    Go back to active records</a>
                </div>
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
                            <tr class="text-center">
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
                            @forelse ($softDeletedData as $check_disbursement_journals)
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
                                        <div x-data="{ open: false }" @click.away="open = false" class="absolute mt-2 relative inline-block text-gray-500 dark:text-gray-400">
                                            <button @click="open = !open" id="dropdownButton" class="inline-block hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                                                <span class="sr-only">Open dropdown</span>
                                                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                </svg>
                                            </button>                                  
                                            <div x-show="open" x-transition:enter="transition-transform transition-opacity ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-transform transition-opacity ease-in duration-200 transform opacity-100 scale-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 py-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md shadow-lg z-10">                                                                                                                                                                                                                     
                                                <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal" wire:click="deleteCheckDisbursementJournal('{{ $check_disbursement_journals->checkdisbursementjournal_no }}', 'force')" class="block px-4 py-2 text-base text-red-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                    Delete
                                                </button>   
                                                <button type="button" wire:click="restoreCheckDisbursementJournal('{{ $check_disbursement_journals->checkdisbursementjournal_no }}')" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                    Restore
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
                        <tfoot class="p-6 bg-white">
                            <tr class="border-t shadow-inner sticky bottom-0 bg-white">
                                <td class="p-4 mr-4 ml-4 flex-grow text-left text-green-800" colspan="100%">
                                    @if (session()->has('message'))
                                    <div class="font-semibold w-full bg-green-50 rounded-lg px-5 py-2.5 flex items-center">
                                        <svg class="w-5 h-5 mr-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"></path>
                                        </svg>
                                        {{ session('message') }}
                                    </div>
                                        @endif
                                    </td>
                                <td class="p-6" colspan="100%">
                                </td>
                            </tr>
                        </tfoot>
                    </table>                   
                </div>   <!-- table container div tag -->             
        </div> <!-- 2nd rectangle div tag -->
        
    </div> <!-- journal main content div tag 2 -->
</div> <!-- journal main content div tag 1 -->