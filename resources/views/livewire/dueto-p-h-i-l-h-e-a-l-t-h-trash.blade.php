<!-- Journal Main Content Style (Padding, Margins, etc.)  -->
<div class=" p-4 sm:ml-60">
    <div class="p-4 border-2 border-gray-200 border-none rounded-lg dark:border-gray-700 mt-8">

        <!-- FIRST RECTANGLE CONTAINING TITLE, SEARCH, DATE, SORT, ETC. -->
        <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 flex flex-col md:flex-row md:items-center justify-between">
            <!-- Title -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between w-full">
                <p class="font-bold text-gray-800 text-xl">Archived Records of Due to PhilHealth</p>
                
                <!-- SVG Icon and Link -->
                <div class="flex items-center mt-4 md:mt-0">

                    <a href="{{ route('DuetoPHILHEALTH') }}" class="btn flex btn-primary text-blue-800 font-semibold">
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
                        <thead class="text-base text-left text-black sticky top-0 bg-white">
                            <!-- VINCEKORIN CODE -->
                            <!-- Include message modal and session message -->
                            @include('livewire.due-to-philhealth-modal')
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