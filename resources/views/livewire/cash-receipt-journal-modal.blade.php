<div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="CashReceiptJournalModal" tabindex="-1" aria-labelledby="CashReceiptJournalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CashReceiptJournalModalLabel">Add Transaction</h5>       
                    <!-- X BUTTON -->
                     <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>               
                <form wire:submit.prevent="saveCashReceiptJournal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Entry Number</label>
                            <input type="int" wire:model="crj_entrynum" class="form-control">
                            @error('crj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" wire:model="crj_entrynum_date" class="form-control">
                            @error('crj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Jev No.</label>
                            <input type="number" wire:model="crj_jevnum" class="form-control">
                            @error('crj_jevnum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Payor</label>
                            <input type="text" wire:model="crj_payor" class="form-control">
                            @error('crj_payor') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Collection Debit</label>
                            <input type="number" wire:model="crj_collection_debit" class="form-control">
                            @error('crj_collection_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Collection Credit</label>
                            <input type="number" wire:model="crj_collection_credit" class="form-control">
                            @error('crj_collection_credit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Deposit Debit</label>
                            <input type="number" wire:model="crj_deposit_debit" class="form-control">
                            @error('crj_deposit_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Deposit Credit</label>
                            <input type="number" wire:model="crj_deposit_credit" class="form-control">
                            @error('crj_deposit_credit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Account Code</label>
                            <input type="text" wire:model="crj_accountcode" class="form-control">
                            @error('crj_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Debit</label>
                            <input type="number" wire:model="crj_debit" class="form-control">
                            @error('crj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Credit</label>
                            <input type="number" wire:model="crj_credit" class="form-control">
                            @error('crj_credit') <span class="text-danger">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="updateCashReceiptJournalModal" tabindex="-1" aria-labelledby="updateCashReceiptJournalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCashReceiptJournalModalLabel">Edit Cash Receipt Journal</h5>                    
                     <!-- X BUTTON -->
                     <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>                   
                </div>
            <form wire:submit.prevent="updateCashReceiptJournal">
                <div class="modal-body">
                        <div class="mb-3">
                            <label>Entry Number</label>
                            <input type="number" wire:model="crj_entrynum" class="form-control">
                            @error('crj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" wire:model="crj_entrynum_date" class="form-control">
                            @error('crj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>-
                        <div class="mb-3">
                            <label>Jev No.</label>
                            <input type="number" wire:model="crj_jevnum" class="form-control">
                            @error('crj_jevnum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Payor</label>
                            <input type="text" wire:model="crj_payor" class="form-control">
                            @error('crj_payor') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Collection Debit</label>
                            <input type="number" wire:model="crj_collection_debit" class="form-control">
                            @error('crj_collection_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Collection Credit</label>
                            <input type="number" wire:model="crj_collection_credit" class="form-control">
                            @error('crj_collection_credit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Deposit Debit</label>
                            <input type="number" wire:model="crj_deposit_debit" class="form-control">
                            @error('crj_deposit_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Deposit Credit</label>
                            <input type="number" wire:model="crj_deposit_credit" class="form-control">
                            @error('crj_deposit_credit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Account Code</label>
                            <input type="text" wire:model="crj_accountcode" class="form-control">
                            @error('crj_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Debit</label>
                            <input type="number" wire:model="crj_debit" class="form-control">
                            @error('crj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Credit</label>
                            <input type="number" wire:model="crj_credit" class="form-control">
                            @error('crj_credit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        
                        <!-- CLOSE BUTTON -->
                        <button type="button" class="btn btn-secondary bg-gray-500 hover:bg-gray-600 focus:bg-gray-600" wire:click="closeModal"
                            data-bs-dismiss="modal">Close
                        </button>

                            <!-- UPDATE BUTTON -->
                        <button type="submit" class="btn px-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                Update
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteCashReceiptJournalModal" tabindex="-1" aria-labelledby="deleteCashReceiptJournalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCashReceiptJournalModalLabel">Delete Cash Receipt Journal</h5>
                    
                    <!-- X BUTTON -->
                    <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="destroyCashReceiptJournal">
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