
<!-- ADD TRANSACTION MODAL -->
<div wire:ignore.self id="add-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        Add New General Journal Entry
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    data-modal-toggle="add-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            
                <!-- Notification Area -->
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif       
            
            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <!-- Modal body -->
                <form wire:submit.prevent="saveGeneralJournal">
                <div class="grid gap-4 p-4 mb-4 grid-cols-2">

                    <div class="col-span-2">
                            <p class = "underline-offset-8 text-base font-bold">General Journal Information</p>
                    </div>
                        <div class="col-span-2">
                            <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Entry Number </label>
                            <input type="text" wire:model="gj_entrynum" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder=""> 
                            @error('gj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Jev Number</label>
                        <input type="number" wire:model="gj_jevnum" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="YYYY-MM-JEV Number"> 
                        @error('gj_jevnum') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Date</label>
                        <input type="date" wire:model="gj_entrynum_date" class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('gj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Particulars</label>
                        <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        textarea id="description" rows="4" wire:model="gj_particulars">
                        @error('gj_particulars') <span class="text-danger">{{ $message }}</span> @enderror
                        </textarea>
                    </div>
                    <div class="col-span-2">
                            <text class = "font-base font-bold">Account Code</label>
                        </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Account Code</label>
                        <input type="text" wire:model="gj_accountcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="X-XX-XX-XXX-X">
                        @error('gj_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Debit</label>
                        <input type="number" wire:model="gj_debit" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="₱">
                        @error('gj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Credit</label>
                        <input type="number" wire:model="gj_credit" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="₱">
                        @error('gj_credit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">General Journal Col</label>
                        <input type="text" wire:model="general_journal_col" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('general_journal_col') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                </div>

                    <div class="col-span-2 flex justify-end mr-2">

                        <button type="button" data-modal-toggle="add-modal" class="mr-2 text-white inline-flex items-center bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Close
                                <span class="sr-only">Close modal</span>
                            </button>    
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<!-- delete MODAL -->
<div wire:ignore.self id="delete-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white" >
                Are you sure you want to delete this item?
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                data-modal-toggle="delete-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
                <!-- Import body -->
                
            </form>
        </div>
    </div>
</div> 

<!-- EXPORT MODAL -->
<div wire:ignore.self id="export-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white" >
                    Export table to CSV or XLSX
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                data-modal-toggle="export-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form wire:submit.prevent="destroyGeneralJournal">
                <!-- Export body -->
                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" x-data="{ exportFormat: 'xlsx' }">
                    <div class="flex flex-col mb-4">
                        <div class="flex items-center">
                            <input id="default-radio-1" type="radio" value="csv" name="default-radio" class="ml-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @click="exportFormat = 'csv'">
                            <label for="default-radio-1" class="ms-2 text-xl font-medium text-gray-900 dark:text-gray-300">CSV</label>
                        </div>
                        <div class="text-base text-gray-500 ml-6">Export table to Comma Separated Value file</div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <div class="flex items-center">
                            <input checked id="default-radio-2" type="radio" value="xlsx" name="default-radio" class="ml-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @click="exportFormat = 'xlsx'">
                            <label for="default-radio-2" class="ms-2 text-xl font-medium text-gray-900 dark:text-gray-300">XLSX</label>
                        </div>
                        <div class="text-base text-gray-500 ml-6">Export table to Microsoft Excel Spreadsheet File</div>
                    </div>


                    <div class="col-span-2 flex justify-end mr-2 mt-4">            
                        <button id="export-csv" button class="text-white inline-flex items-center bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                        wire:click="exportGJ_CSV" x-show="exportFormat === 'csv'">Export</button>
                        <button id="export-xlsx" button class="text-white inline-flex items-center bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                        wire:click="exportGL_XLSX" x-show="exportFormat === 'xlsx'">Export</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div> 

<!-- IMPORT MODAL -->
<div wire:ignore.self id="import-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white" >
                    Import data to journal
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                data-modal-toggle="import-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
                <!-- Import body -->
                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center justify-center w-full">
                        <label for="customFile" class="relative flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400" id="fileName">
                                    @if($file)
                                        <span class="font-semibold">{{ $file->getClientOriginalName() }}</span> <!--Madidisplay name ng uploaded file-->
                                    @else
                                        <span class="font-semibold">Click to upload Excel file</span>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Make sure that your header rows match the header rows in this table.</p>
                                    @endif
                                </p>
                            </div>
                            <input type="file" wire:model="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="customFile" />
                        </label>
                    </div>
                    <div class="col-span-2 flex justify-end mr-2 mt-4">            
                        <button class="text-white inline-flex items-center bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                            wire:click="importGJ">
                            Import 
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 



<!-- EDIT TRANSACTION MODAL -->
<div  wire:ignore.self id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white" >
                    Edit General Journal Entry
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                data-modal-toggle="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Notification Area -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif       
            
                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <!-- Modal body -->
                <form wire:submit.prevent="updateGeneralJournal">
                    <div class="grid gap-4 p-4 mb-4 grid-cols-2">

                    <div class="col-span-2">
                            <p class = "underline-offset-8 text-base font-bold">General Journal Information</p>
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Entry Number </label>
                            <input type="text" wire:model="gj_entrynum" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> 
                            @error('gj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Jev Number</label>
                        <input type="number" wire:model="gj_jevnum" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> 
                        @error('gj_jevnum') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Date</label>
                        <input type="date" wire:model="gj_entrynum_date" class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('gj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Particulars</label>
                        <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        textarea id="description" rows="4" wire:model="gj_particulars">
                        @error('gj_particulars') <span class="text-danger">{{ $message }}</span> @enderror
                        </textarea>
                    </div>
                    <div class="col-span-2">
                            <text class = "font-base font-bold">Account Code</label>
                        </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Account Code</label>
                        <input type="text" wire:model="gj_accountcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('gj_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Debit</label>
                        <input type="number" wire:model="gj_debit" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('gj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Credit</label>
                        <input type="number" wire:model="gj_credit" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('gj_credit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">General Journal Col</label>
                        <input type="text" wire:model="general_journal_col" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('general_journal_col') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                </div>

                <div class="col-span-2 flex justify-end mr-2">
                    <button type="submit" data-modal-toggle="edit-modal" class="mr-2 text-white inline-flex items-center bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Close
                        </button>    
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Update
                        </button>
                </div>
            </form>
        </div>
    </div>
</div> 

