<!-- Journal Main Content Style (Padding, Margins, etc.)  -->
<div class="p-4 sm:ml-60">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-8">

        <!-- FIRST RECTANGLE CONTAINING TITLE, SEARCH, DATE, SORT, ETC. -->
        <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 flex flex-col md:flex-row md:items-center justify-between">
            <!-- Title -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between w-full">
                <p class="font-bold text-gray-800 text-xl">Archived Records of Check Disbursement Journal</p>
                
                <!-- SVG Icon and Link -->
                <div class="flex items-center mt-4 md:mt-0">
                    <a href="{{ route('CheckDisbursementJournalArchived') }}" class="btn flex btn-primary text-blue-800 font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke-width="1.8" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0L9 3M3 9h12a6 6 0 0 1 0 12h-3"></path>
                        </svg>
                        Go back to active records
                    </a>
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
                        @include('livewire.check-disbursement-journal-modal')
                        <tr class="text-center shadow-md">
                            <th scope="col" class="border-r p-2" style="width: 10px">No.</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 100px">Date</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 150px">Check No.</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 200px">Payee</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 100px">BUR</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 120px">CIB-LCCA</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 120px">Salary & Wages</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 120px">Honoraria</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 120px">Account Code</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 120px">Debit</th>
                            <th scope="col" class="border-r border-l p-2" style="width: 120px">Credit</th>
                            <th scope="col" class="bg-white justify-end" style="width:10px"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> <!-- 2nd rectangle div tag -->
    </div> <!-- journal main content div tag 2 -->
</div> <!-- journal main content div tag 1 -->