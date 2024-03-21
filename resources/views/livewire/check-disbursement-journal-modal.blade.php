<div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="CheckDisbursementJournalModal" tabindex="-1" aria-labelledby="CheckDisbursementJournalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CheckDisbursementJournalModalLabel">Add Transaction</h5>
                    <!-- X BUTTON -->
                    <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="saveCheckDisbursementJournal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Entry Number</label>
                            <input type="number" wire:model="ckdj_entrynum" class="form-control">
                            @error('ckdj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" wire:model="ckdj_entrynum_date" class="form-control">
                            @error('ckdj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Check No.</label>
                            <input type="number" wire:model="ckdj_checknum" class="form-control">
                            @error('ckdj_checknum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Payee</label>
                            <input type="text" wire:model="ckdj_payee" class="form-control">
                            @error('ckdj_payee') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>BUR</label>
                            <input type="number" wire:model="ckdj_bur" class="form-control">
                            @error('ckdj_bur') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>CIB-LCCA</label>
                            <input type="number" wire:model="ckdj_cib_lcca" class="form-control">
                            @error('ckdj_cib_lcca') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>2-02-01-010-A</label>
                            <input type="number" wire:model="ckdj_account1" class="form-control">
                            @error('ckdj_account1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>2-02-01-010-B</label>
                            <input type="number" wire:model="ckdj_account2" class="form-control">
                            @error('ckdj_account2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>22-02-01-010-E</label>
                            <input type="number" wire:model="ckdj_account3" class="form-control">
                            @error('ckdj_account3') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Sal&Wages</label>
                            <input type="number" wire:model="ckdj_salary_wages" class="form-control">
                            @error('ckdj_salary_wages') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Honoraria</label>
                            <input type="number" wire:model="ckdj_honoraria" class="form-control">
                            @error('ckdj_honoraria') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label> Sundry Account Code</label>
                            <input type="text" wire:model="ckdj_sundry_accountcode" class="form-control">
                            @error('ckdj_sundry_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Debit</label>
                            <input type="number" wire:model="ckdj_debit" class="form-control">
                            @error('ckdj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Credit</label>
                            <input type="number" wire:model="ckdj_credit" class="form-control">
                            @error('ckdj_credit') <span class="text-danger">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="updateCheckDisbursementJournalModal" tabindex="-1" aria-labelledby="updateCheckDisbursementJournalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCheckDisbursementJournalModalLabel">Edit Check Disbursement Journal</h5>
                    <!-- X BUTTON -->
                    <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            <form wire:submit.prevent="updateCheckDisbursementJournal">
                <div class="modal-body">
                        <div class="mb-3">
                            <label>Entry Number</label>
                            <input type="number" wire:model="ckdj_entrynum" class="form-control">
                            @error('ckdj_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" wire:model="ckdj_entrynum_date" class="form-control">
                            @error('ckdj_entrynum_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Check No.</label>
                            <input type="number" wire:model="ckdj_checknum" class="form-control">
                            @error('ckdj_checknum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Payee</label>
                            <input type="text" wire:model="ckdj_payee" class="form-control">
                            @error('ckdj_payee') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>BUR</label>
                            <input type="number" wire:model="ckdj_bur" class="form-control">
                            @error('ckdj_bur') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>CIB-LCCA</label>
                            <input type="number" wire:model="ckdj_cib_lcca" class="form-control">
                            @error('ckdj_cib_lcca') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>2-02-01-010-A</label>
                            <input type="number" wire:model="ckdj_account1" class="form-control">
                            @error('ckdj_account1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>2-02-01-010-B</label>
                            <input type="number" wire:model="ckdj_account2" class="form-control">
                            @error('ckdj_account2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>22-02-01-010-E</label>
                            <input type="number" wire:model="ckdj_account3" class="form-control">
                            @error('ckdj_account3') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Sal&Wages</label>
                            <input type="number" wire:model="ckdj_salary_wages" class="form-control">
                            @error('ckdj_salary_wages') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Honoraria</label>
                            <input type="number" wire:model="ckdj_honoraria" class="form-control">
                            @error('ckdj_honoraria') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label> Sundry Account Code</label>
                            <input type="text" wire:model="ckdj_sundry_accountcode" class="form-control">
                            @error('ckdj_sundry_accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Debit</label>
                            <input type="number" wire:model="ckdj_debit" class="form-control">
                            @error('ckdj_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Credit</label>
                            <input type="number" wire:model="ckdj_credit" class="form-control">
                            @error('ckdj_credit') <span class="text-danger">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="deleteCheckDisbursementJournalModal" tabindex="-1" aria-labelledby="deleteCheckDisbursementJournalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCheckDisbursementJournalModalLabel">Delete Check Disbursement Journal</h5>
                     <!-- X BUTTON -->
                     <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="destroyCheckDisbursementJournal">
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
    </div>
</div>