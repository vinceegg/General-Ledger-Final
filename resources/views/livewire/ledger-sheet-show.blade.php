<!-- Journal Main Content Style (Padding, Margins, etc.)  -->
<div class=" p-4 sm:ml-60 ">
    <div class="p-4 rounded-lg dark:border-gray-700 mt-8 ">



        <div class="p-6 mb-4 bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-1 md:grid-cols-2">
              <div class="p-2 bg-white rounded-lg">
                <!-- Content for first cell -->
                <div>
                    <p class="font-extrabold text-blue-800 text-3xl">Ledger Sheets</p>
                </div>
              </div>
              <div class="bg-white rounded-lg">
                <!-- Content for second cell -->
                @php
        $accountNames = [
            '1 01 01 010 - Cash Local Treasury',
            '1 01 01 020 - Petty Cash',
            '1 01 02 010 - Cash in Bank Local Currency Current Account',
            '1 02 01 010 - Cash in Bank Local Currency Time Deposits',
            '1 03 01 010 - Accounts Receivable',
            '1 03 01 070 - Interests Receivable',
            '1 07 05 020 - Office Equipment',
            '1 07 05 021 - Accumulated Depreciation Office Equipment',
            '1 07 05 030 - Info and Communication Technology Equipment',
            '1 07 05 031 - Accumulated Depreciation ICT Equipment',
            '1 07 05 090 - Disaster Response and Rescue Equipment',
            '1 07 05 091 - Acc Depreciation Disaster Response and Rescue Equipment',
            '1 07 05 100 - Military Police Security Equipment',
            '1 07 05 101 - Acc Depreciation Military Police Security Eqpmnt',
            '1 07 05 110 - Medical Equipment',
            '1 07 05 111 - Accumulated Depreciation Medical Equipment',
            '1 07 05 130 - Sports Equipment',
            '1 07 05 131 - Accumulated Depreciation Sports Equipment',
            '1 07 05 140 - Technical and Scientific Equipment',
            '1 07 05 141 - Acc Depreciation Technical Scientific Equipment',
            '1 07 05 990 - Other Machinery Equipment',
            '1 07 05 991 - Acc Depreciation Other Machinery Equipment',
            '4 04 02 020 - Grants Donations in Kind',
            '4 06 01 010 - Miscellaneous Income',
            '5 01 01 010 - Salaries and Wages Regular',
            '5 01 01 020 - Salaries and Wages Casual Contractual',
            '5 01 02 010 - Personnel Economic Relief Allowance',
            '5 01 02 020 - Representation Allowance',
            '5 01 02 030 - Transportation Allowance',
            '5 01 02 040 - Clothing Uniform Allowance',
            '5 01 02 100 - Honoraria',
            '5 01 02 110 - Hazard Pay',
            '5 01 02 120 - Longetivity Pay',
            '5 01 02 130 - Overtime and Night Pay',
            '5 01 02 140 - Year End Bonus',
            '5 01 02 150 - Cash Gift',
            '5 01 03 010 - Retirement and Life Insurance Premiums',
            '5 01 03 020 - Pag ibig Contributions',
            '5 01 03 030 - PhilHealth Contributions',
            '5 01 03 040 - Employees Compensation Insurance Premiums',
            '5 01 04 030 - Terminal Leave Benefits',
            '5 01 04 990 - Other Personnel Benefits',
            '5 02 01 010 - Traveling Expenses Local',
            '5 02 02 010 - Training Expenses',
            '5 02 03 010 - Office Supplies Expenses',
            '5 02 03 020 - Accountable Forms Expenses',
            '5 02 03 070 - Drugs and Medicines Expenses',
            '5 02 03 080 - Medical Dental and Laboratory Supplies Expenses',
            '5 02 03 090 - Fuel Oil and Lubricants Expenses',
            '5 02 03 990 - Other Supplies and Materials Expenses',
            '5 02 04 010 - Water Expenses',
            '5 02 04 020 - Electricity Expenses',
            '5 02 05 010 - Postage and Courier Services',
            '5 02 05 020 - Telephone Expenses',
            '5 02 05 030 - Internet Subscription Expenses',
            '5 02 10 030 - Extraordinary and Miscellaneous Expenses',
            '1 07 06 010 - Motor Vehicles',
            '1 07 06 011 - Accumulated Depreciation Motor Vehicles',
            '1 07 07 010 - Furniture and Fixtures',
            '1 07 07 011 - Accumulated Depreciation Furniture and Fixtures',
            '1 07 10 030 - Buildings and Other Structures',
            '2 01 01 010 - Accounts Payable',
            '2 01 01 020 - Due to Officers and Employees',
            '2 02 01 010 - Due to BIR',
            '2 02 01 020 - Due to GSIS',
            '2 02 01 030 - Due to PAG IBIG',
            '2 02 01 040 - Due to PHILHEALTH',
            '2 04 01 010 - Trust Liabilities',
            '2 04 01 050 - Guaranty Security Deposits Payable',
            '2 04 01 050 - Customers Deposit',
            '2 05 01 990 - Other Deferred Credits',
            '2 99 99 990 - Other Payables',
            '3 01 01 010 - Government Equity',
            '3 01 01 020 - Prior Period Adjustment',
            '4 02 01 980 - Fines and Penalties Service Income',
            '4 02 02 010 - School Fees',
            '4 02 02 020 - Affiliation Fees',
            '4 02 02 050 - Rent Income',
            '4 02 02 220 - Interest Income',
            '4 02 02 990 - Other Business Income',
            '4 03 01 020 - Subsidy from LGUs',
            '5 02 11 990 - Other Professional Services',
            '5 02 13 040 - Repairs and Maint Building Other Structures',
            '5 02 13 050 - Repairs and Maint Machinery and Equipment',
            '5 02 13 060 - Repairs and Maint Transportation Equipment',
            '5 02 16 020 - Fidelity Bond Premiums',
            '5 02 16 030 - Insurance Expenses',
            '5 02 99 020 - Printing and Publication Expenses',
            '5 02 99 030 - Representation Expenses',
            '5 02 99 050 - Rent Expenses',
            '5 02 99 060 - Membership Dues and Contribution to Org',
            '5 02 99 070 - Subscription Expenses',
            '5 02 99 990 - Other Maintenance and Operating Expenses',
            '5 03 01 040 - Bank Charges',
            '5 05 01 040 - Depreciation Building and Structures',
            '5 05 01 050 - Depreciation Machinery and Equipment',
            '5 05 01 060 - Depreciation Transportation Equipment',
            '5 05 01 070 - Depreciation Furnitures and Books'
        ];
        @endphp
        <!-- Select Account Name -->
        <select id="account" wire:model="ls_accountcode" wire:change="setAccountName($event.target.value)" class="w-full border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
            <option value="" class="text-gray-500">Select Account</option>
            @foreach ($accountNames as $account)
                <option value="{{ $account }}" class="text-gray-700">{{ $account }}</option>
            @endforeach
        </select>
        
              </div>
              <div class="p-2 bg-white rounded-lg ">
                
                <!-- Content for third cell -->
                <div class="flex flex-col items-start justify-between">
                    <p class="font-bold text-gray-800 text-xl">{{$ls_accountname ?? "All Accounts Ledger Entries"}}</p>
                    {{-- <p class="text-yellow-600 mt-2">General Ledger > <span class="text-black">Ledger Sheet > {{$ls_accountname ?? "Ledger Sheets"}}</span></p> --}}
                </div>
                                <div class="flex flex-col items-left justify-between">
                    <p class="text-yellow-600 mt-2"> General Ledger <span class="text-black">> Ledger Sheet</span></p>
                </div>
              </div>
              <div class="bg-white rounded-lg">
                <div class="bg-white  rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                      <div class="bg-white rounded-lg">
                        <!-- Content for first cell -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div class="bg-white rounded-lg">
                                <!-- Content for first cell Search -->
                                <div class="w-full bg-white rounded-lg relative flex-1" x-data="searchComponent()" @keydown.escape.window="search = ''; results = []" @click.away="search = ''; results = []">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="text" x-model="search" @input.debounce.300="updateResults()" @blur="search ? null : results = []" class="w-full pl-10 pr-2 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search...">
                                    <div x-show="results.length > 0" class="shadow-xl absolute z-10 mt-1 bg-white border border-gray-300 rounded w-full">
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
                            <div class="bg-white  rounded-lg">
                                <!-- Content for second cell Datepicker-->
                                <!-- Select Date -->        
                                <label for="date-range" class="rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-0"></label>
                                <input type="month" id="date-range" placeholder="Select Date" wire:model="selectedMonth" wire:change="sortDate" class="form-control w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            </div>
                      </div>
                      <div class="bg-white  rounded-lg dark:bg-gray-800 dark:border-green-500">
                        <!-- Content for second cell Multiple Buttons for Import, Export, Add Transaction-->
                        
                        <div class="grid grid-cols-3 gap-2 text-center items-center justify-center h-full">
                            <div class="text-center items-center">
                                <!-- Import -->
                                <button class="w-full text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center flex justify-center items-center" style="font-weight: bold;" 
                                data-modal-target="import-modal" data-modal-toggle="import-modal">Import</button>
                            </div>
                            <div class="text-center items-center">
                                <!-- Export -->
                                <button class="w-full text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center flex justify-center items-center" style="font-weight: bold;" 
                                data-modal-target="export-modal" data-modal-toggle="export-modal">Export</button>
                            </div>
                            <div class="text-center items-center">
                                <!-- Add -->
                                <button type="button" wire:click="resetInput" class="w-full text-white bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center justify-center flex items-center" style="font-weight: bold;"
                                data-modal-target="add-modal" data-modal-toggle="add-modal">+ Add Entry</button>
                            </div>
                        </div>
                    
                      </div>
                    
                    </div>
                  </div>
                  
                <!-- Content for fourth cell -->
                    
                <!-- Functions & features in first rectangle -->
                <div class="flex flex-wrap md:justify-end">
                                             <!-- Sort Button -->
                                             <div x-data="{ open: false }" class="relative inline-block text-left">
                                                <a @click="open = !open" class="relative group bg-white hover:bg-yellow-250 hover:text-black rounded-lg px-3 py-2.5 text-center inline-flex items-center cursor-pointer">
                                                    <svg class="w-6 h-6 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 20V10m0 10-3-3m3 3 3-3m5-13v10m0-10 3 3m-3-3-3 3"/>
                                                    </svg>
                                                    <span class="ml-2">
                                                        <span x-text="$wire.sortDirection === 'asc' ? '' : ($wire.sortDirection === 'desc' ? 'Oldest First' : 'Sort')"></span>
                                                    </span>
                                                    <!-- Tooltip -->
                                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-32 bg-white border border-gray-300 text-black shadow-md text-center text-sm rounded-lg px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                        Sort Options
                                                    </div>
                                                </a>
                                                <div x-show="open" @click.away="open = false" class="absolute z-10 mt-2 bg-white border border-gray-300 text-black shadow-md rounded-lg">
                                                    <div class="block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-center text-sm">
                                                        <div @click="open = false; $wire.sortDirection = 'asc'; $wire.sortAction()" class="cursor-pointer py-1 px-2 hover:bg-gray-200">Newest Added Entries</div>
                                                        <div @click="open = false; $wire.sortDirection = 'desc'; $wire.sortAction()" class="cursor-pointer py-1 px-2 hover:bg-gray-200">Oldest Added Entries</div>
                                                    </div>
                                                </div>
                                            </div>
                                            


                                                <!-- Save Button -->
                                              <a href="{{ route('LedgerSheetArchive') }}" class="relative group border-none bg-none rounded-lg px-3 py-2.5 text-center inline-flex items-center">
                                                <svg class="w-6 h-6 text-gray-700 hover:text-green-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                  <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                                                  <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                                                </svg>
                                                <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-32 bg-white border border-gray-300 text-black shadow:md text-center text-sm rounded-lg px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                  Save
                                                </div>
                                              </a>
                                            
                                              <!-- Archive button -->
                                              <a href="{{ route('LedgerSheetArchive') }}" class="relative group rounded-lg px-3 py-2.5 text-center inline-flex items-center">
                                                <svg class="w-6 h-6" data-slot="icon" fill="none" stroke-width="1.5" stroke="#000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"></path>
                                                </svg>
                                                <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-32 bg-white border border-gray-300 text-black shadow:md text-center text-sm rounded-lg px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                  View Archives
                                                </div>
                                              </a>
                                            </div>

  

              </div>
            </div>
        </div>
          




        
        <!-- 2ND RECTANGLE CONTAINING THE JOURNAL TABLE -->
        <div class="p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <!-- Table Container -->
                <div class="relative overflow-x-auto overflow-y-auto sm:rounded-lg" style="max-height:74vh">
                    <table class="w-full text-base text-left rtl:text-right table-auto text-gray-700 dark:text-gray-400">

                        <!-- Table Header -->
                        <thead class="text-base text-left text-black sticky top-0 bg-white">
                            <!-- VINCEKORIN CODE -->
                            <!-- Include message modal and session message -->
                            @include('livewire.ledger-sheet-modal')
                            <tr class="text-center shadow-md"> <!-- Table heading design -->
                                <th scope="col" class="border-r border-l p-2" style="width: 100px">Date</th>
                                <th scope="col" class="border-r border-l p-2" style="width: 150px">Voucher No.</th>
                                <th scope="col" class="border-r border-l p-2">Particulars</th>
                                <th scope="col" class="border-r border-l p-2" style="width: 180px">Balance Debit</th>
                                <th scope="col" class="border-l p-2" style="width: 120px">Debits</th>
                                <th scope="col" class="border-l p-2" style="width: 120px">Credits</th>
                                <th scope="col" class="border-l p-2" style="width: 180px">Credits Balance</th>
                                <th scope="col" class="bg-white justify-end" style="width:10px">                                   
                                </th>                 
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody class="space-y-4  overflow-y-scroll  ">
                            @forelse ($ledger_sheet as $ledger_sheets)
                                <tr class = "border-b border-gray-300 ">
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $ledger_sheets-> ls_date}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $ledger_sheets-> ls_vouchernum}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $ledger_sheets-> ls_particulars}}</td>                               
                                    <td class="border-r border-b border-l p-2 border-gray-300">₱{{ number_format($ledger_sheets->ls_balance_debit, 2, '.', ',') }}</td>                                 
                                    <td class="border-r border-b border-l p-2 border-gray-300">₱{{ number_format($ledger_sheets->ls_debit, 2, '.', ',') }}</td>                                 
                                    <td class="border-r border-b border-l p-2 border-gray-300">₱{{ number_format($ledger_sheets->ls_credit, 2, '.', ',') }}</td>                      
                                    <td class="border-b border-l p-2 border-gray-300">₱{{ number_format($ledger_sheets->ls_credit_balance, 2, '.', ',') }}</td>                                     
                                    <td class="justify-end">
                                        <div x-data="{ open: false }" @click.away="open = false" class="mt-2 relative inline-block text-gray-500 dark:text-gray-400">
                                            <button @click="open = !open" id="dropdownButton" class="inline-block hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                                                <span class="sr-only">Open dropdown</span>
                                                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                </svg>
                                            </button>
                                            <div x-show="open" x-transition:enter="transition-transform transition-opacity ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-transform transition-opacity ease-in duration-200 transform opacity-100 scale-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 py-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md shadow-lg z-10">  
                                                <!-- Show Edit and Archive only for active records -->
                                                <button type="button" data-modal-target="edit-modal" data-modal-toggle="edit-modal" wire:click="editGeneralLedger({{ $ledger_sheets->ls_vouchernum }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                    Edit
                                                </button> 
                                                <button type="button" wire:click="softDeleteGeneralLedger({{ $ledger_sheets->ls_vouchernum }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
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
                                <td colspan="3" class="px-6 py-4 font-large text-gray-900 whitespace-nowrap dark:text-white text-right font-bold">Sub Total:</td>
                                <td class="font-bold">₱{{ number_format($totalBalanceDebit, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalDebit, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalCredit, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalCreditBalance, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>                   
                </div>   <!-- table container div tag -->             
        </div>
         <!-- 2nd rectangle div tag --> 

    </div> <!-- journal main content div tag 2 -->



</div> <!-- journal main content div tag 1 -->
