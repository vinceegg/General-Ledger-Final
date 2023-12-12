<div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="CashDisbursementJournalModal" tabindex="-1" aria-labelledby="CashDisbursementJournalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CashDisbursementJournalModalLabel">Add Transaction</h5>
                    
                    <!-- X BUTTON -->
                    <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>

                </div>
                <form wire:submit.prevent="saveCashDisbursementJournal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Entry Number</label>
                            <input type="number" wire:model="cdj_entrynum" class="form-control">
                            @error('cdj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" wire:model="cdj_entrynum_date" class="form-control">
                            @error('cdj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Reference/RD No.</label>
                            <input type="text" wire:model="cdj_referencenum" class="form-control">
                            @error('cdj_referencenum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Accountable Officer</label>
                            <input type="text" wire:model="cdj_accountable_officer" class="form-control">
                            @error('cdj_accountable_officer') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>JEV No.</label>
                            <input type="number" wire:model="cdj_jevnum" class="form-control">
                            @error('cdj_jevnum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Account Code</label>
                            <input type="number" wire:model="cdj_accountcode" class="form-control">
                            @error('cdj_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Amount</label>
                            <input type="number" wire:model="cdj_amount" class="form-control">
                            @error('cdj_amount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>5-02-99-990</label>
                            <input type="number" wire:model="cdj_account1" class="form-control">
                            @error('cdj_account1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>5-02-02-010</label>
                            <input type="number" wire:model="cdj_account2" class="form-control">
                            @error('cdj_account2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Sundry Account Code</label>
                            <input type="text" wire:model="cdj_sundry_accountcode" class="form-control">
                            @error('cdj_sundry_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>PR</label>
                            <input type="text" wire:model="cdj_pr" class="form-control">
                            @error('cdj_pr') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Debit</label>
                            <input type="number" wire:model="cdj_debit" class="form-control">
                            @error('cdj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Credit</label>
                            <input type="number" wire:model="cdj_credit" class="form-control">
                            @error('cdj_credit') <span class="text-danger">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="updateCashDisbursementJournalModal" tabindex="-1" aria-labelledby="updateCashDisbursementJournalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCashDisbursementJournalModalLabel">Edit Cash Disbursement Journal</h5>
                    <!-- X BUTTON -->
                    <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="updateCashDisbursementJournal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Entry Number</label>
                            <input type="number" wire:model="cdj_entrynum" class="form-control">
                            @error('cdj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" wire:model="cdj_entrynum_date" class="form-control">
                            @error('cdj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Reference/RD No.</label>
                            <input type="number" wire:model="cdj_referencenum" class="form-control">
                            @error('cdj_referencenum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Accountable Officer</label>
                            <input type="text" wire:model="cdj_accountable_officer" class="form-control">
                            @error('cdj_accountable_officer') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>JEV No.</label>
                            <input type="number" wire:model="cdj_jevnum" class="form-control">
                            @error('cdj_jevnum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Account Code</label>
                            <input type="number" wire:model="cdj_accountcode" class="form-control">
                            @error('cdj_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Amount</label>
                            <input type="number" wire:model="cdj_amount" class="form-control">
                            @error('cdj_amount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>5-02-99-990</label>
                            <input type="number" wire:model="cdj_account1" class="form-control">
                            @error('cdj_account1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>5-02-02-010</label>
                            <input type="number" wire:model="cdj_account2" class="form-control">
                            @error('cdj_account2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Sundry Account Code</label>
                            <input type="text" wire:model="cdj_sundry_accountcode" class="form-control">
                            @error('cdj_sundry_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>PR</label>
                            <input type="text" wire:model="cdj_pr" class="form-control">
                            @error('cdj_pr') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Debit</label>
                            <input type="number" wire:model="cdj_debit" class="form-control">
                            @error('cdj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Credit</label>
                            <input type="number" wire:model="cdj_credit" class="form-control">
                            @error('cdj_credit') <span class="text-danger">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="deleteCashDisbursementJournalModal" tabindex="-1" aria-labelledby="deleteCashDisbursementJournalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCashDisbursementJournalModalLabel">Delete Cash Disbursement Journal</h5>
                    <!-- X BUTTON -->
                    <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="destroyCashDisbursementJournal">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data ?</h4>
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
</div></div>