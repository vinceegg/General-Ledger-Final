<!-- Journal Main Content Style (Padding, Margins, etc.)  -->
<div class=" p-4 sm:ml-60">
    <div class="p-4 border-2 border-gray-200 border-none rounded-lg dark:border-gray-700 mt-8">

        <!-- FIRST RECTANGLE CONTAINING TITLE, SEARCH, DATE, SORT, ETC. -->
        <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 flex flex-col md:flex-row md:items-center justify-between">
                <!-- Title -->
                <div class="flex flex-col items-left justify-between">
                    <p class="font-extrabold text-blue-800 text-3xl">Training Expenses</p>
                    <p class="text-yellow-600 mt-2">General Ledger > <span class="text-black">Ledger Sheet > Training Expenses</span></p>
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
                    <!-- Note: nilipat ko sa ginawa kong import modal yung choose file -mari -->
                    <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" 
                        data-modal-target="import-modal" data-modal-toggle="import-modal" >Import</button>

                    <!-- Export -->
                    <!-- @frontend heree need onting editing sa UI <3 done! -->
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
                    <a href="{{ route('TrainingExpensesArchived') }}" class="relative group border border-gray-300 bg-white hover:bg-gray-200 hover:text-black rounded-lg px-3 py-2.5 text-center inline-flex items-center">
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
                        <thead class="text-base text-left text-black sticky top-0 bg-white">
                            <!-- VINCEKORIN CODE -->
                            <!-- Include message modal and session message -->
                            @include('livewire.training-expenses-modal')
                            <tr class="text-center shadow-md"> <!-- Table heading design -->
                                <th scope="col" class="border-r p-2" style="width: 10px">No.</th>
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
                            @forelse ($general_ledger as $general_ledgers)
                                <tr class = "border-b border-gray-300 ">
                                    <td scope="row" class="border-r border-b p-2 border-gray-300 px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $general_ledgers-> id }}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $general_ledgers-> gl_date}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $general_ledgers-> gl_vouchernum}}</td>
                                    <td class="border-r border-b border-l p-2 border-gray-300">{{ $general_ledgers-> gl_particulars}}</td>                               
                                    <td class="border-r border-b border-l p-2 border-gray-300">₱{{ number_format($general_ledgers->gl_balance_debit, 2, '.', ',') }}</td>                                 
                                    <td class="border-r border-b border-l p-2 border-gray-300">₱{{ number_format($general_ledgers->gl_debit, 2, '.', ',') }}</td>                                 
                                    <td class="border-r border-b border-l p-2 border-gray-300">₱{{ number_format($general_ledgers->gl_credit, 2, '.', ',') }}</td>                      
                                    <td class="border-b border-l p-2 border-gray-300">₱{{ number_format($general_ledgers->gl_credit_balance, 2, '.', ',') }}</td>                                     
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
                                                <button type="button" data-modal-target="edit-modal" data-modal-toggle="edit-modal" wire:click="editGeneralLedger({{ $general_ledgers->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                                    Edit
                                                </button> 
                                                <button type="button" wire:click="softDeleteGeneralLedger({{ $general_ledgers->id }})" class="block px-4 py-2 text-base text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
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
                                <td colspan="4" class="px-6 py-4 font-large text-gray-900 whitespace-nowrap dark:text-white text-right font-bold">Sub Total:</td>
                                <td class="font-bold">₱{{ number_format($totalBalanceDebit, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalDebit, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalCredit, 2) }}</td>
                                <td class="font-bold">₱{{ number_format($totalCreditBalance, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>                   
                </div>   <!-- table container div tag -->             
        </div> <!-- 2nd rectangle div tag --> 

    </div> <!-- journal main content div tag 2 -->
</div> <!-- journal main content div tag 1 -->