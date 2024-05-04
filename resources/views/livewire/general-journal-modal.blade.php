<!-- ADD TRANSACTION MODAL -->
<div  wire:ignore.self id="add-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Add New General Journal Entry
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-base w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-modal">
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
            <form wire:submit.prevent="saveGeneralJournal">
                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <!-- Modal body -->
                <form >
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
                    <button type="submit" data-modal-toggle="crud-modal" class="mr-2 text-white inline-flex items-center bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Close
                        </button>    
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add
                        </button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- EDIT MODAL -->
<div  id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden modal fade overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
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
            <form wire:submit.prevent="updateGeneralJournal">
                <!-- Notification Area -->
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif       
               
                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <!-- Modal body -->
                <form class="p-8 md:p-5 auto">
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
                    <button type="submit" data-modal-toggle="crud-modal" class="mr-2 text-white inline-flex items-center bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Close
                        </button>    
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add
                        </button>
                </div>
            </form>
        </div>
    </div>
</div> 