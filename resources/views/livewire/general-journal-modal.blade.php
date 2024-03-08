<div>
    <!-- Insert Modal -->
<div wire:ignore.self class="modal fade" id="GeneralJournalModal" tabindex="-1" aria-labelledby="GeneralJournalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="GeneralJournalModal">Add Transaction</h5>

                <!-- X BUTTON -->
                <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"y>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
            </div>
            <form wire:submit.prevent="saveGeneralJournal">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Entry Number</label>
                        <input type="text" wire:model="gj_entrynum" class="form-control">
                        @error('gj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" wire:model="gj_entrynum_date" class="form-control">
                        @error('gj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Jev Number</label>
                        <input type="number" wire:model="gj_jevnum" class="form-control">
                        @error('gj_jevnum') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Particulars</label>
                        <input type="text" wire:model="gj_particulars" class="form-control">
                        @error('gj_particulars') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Account Code</label>
                        <input type="text" wire:model="gj_accountcode" class="form-control">
                        @error('gj_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Debit</label>
                        <input type="number" wire:model="gj_debit" class="form-control">
                        @error('gj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Credit</label>
                        <input type="number" wire:model="gj_credit" class="form-control">
                        @error('gj_credit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>General Journal Col</label>
                        <input type="text" wire:model="general_journal_col" class="form-control">
                        @error('general_journal_col') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- CLOSE BUTTON -->
                    <button type="button" class="btn btn-secondary bg-gray-500 hover:bg-gray-600 focus:bg-gray-600" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>

                        <!-- ADD BUTTON -->
                        <button type="submit" class="btn px-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                            Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div wire:ignore.self class="modal fade" id="updateGeneralJournalModal" tabindex="-1" aria-labelledby="updateGeneralJournalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateGeneralJournalModalLabel">Edit General Journal</h5>
               <!-- X BUTTON -->
               <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
            </div>
            <form wire:submit.prevent="updateGeneralJournal">
                <div class="modal-body">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Entry Number</label>
                        <input type="text" wire:model="gj_entrynum" class="form-control">
                        @error('gj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" wire:model="gj_entrynum_date" class="form-control">
                        @error('gj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Jev Number</label>
                        <input type="number" wire:model="gj_jevnum" class="form-control">
                        @error('gj_jevnum') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Particulars</label>
                        <input type="text" wire:model="gj_particulars" class="form-control">
                        @error('gj_particulars') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Account Code</label>
                        <input type="text" wire:model="gj_accountcode" class="form-control">
                        @error('gj_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Debit</label>
                        <input type="number" wire:model="gj_debit" class="form-control">
                        @error('gj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Credit</label>
                        <input type="number" wire:model="gj_credit" class="form-control">
                        @error('gj_credit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>General Journal Col</label>
                        <input type="text" wire:model="general_journal_col" class="form-control">
                        @error('general_journal_col') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- CLOSE BUTTON -->
                    <button type="button" class="btn btn-secondary bg-gray-500 hover:bg-gray-600 focus:bg-gray-600" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>

                    <!-- UPDATE BUTTON -->
                    <button type="submit" class="btn px-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Update</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteGeneralJournalModal" tabindex="-1" aria-labelledby="deleteGeneralJournalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteGeneralJournalModalLabel">Delete General Journal</h5>
                    
                    <!-- X BUTTON -->
                    <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="destroyGeneralJournal">
                    <div class="modal-body">
                        <h4>Are you sure you want to permanently delete this data?</h4>
                    </div>
                    <div class="modal-footer">

                        <!-- CLOSE BUTTON -->
                    <button type="button" class="btn btn-secondary bg-gray-500 hover:bg-gray-600 focus:bg-gray-600" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>

                        <!-- DELETE BUTTON -->
                        <button type="submit" class="btn px-3 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-400">
                            Delete </button>
                   </div>
                </form>
            </div>
        </div>
    </div>
</div>
