<div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="GeneralLedgerModal" tabindex="-1" aria-labelledby="GeneralLedgerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="GeneralLedgerModalLabel">Add Transaction</h5>       
                    <!-- X BUTTON -->
                     <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>               
                <form wire:submit.prevent="saveGeneralLedger">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Symbol</label>
                            <input type="number" wire:model="gl_symbol" class="form-control">
                            @error('gl_symbol') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Name of Fund or Account</label>
                            <input type="text" wire:model="gl_fundname" class="form-control">
                            @error('gl_fundname') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Functional Classification</label>
                            <input type="text" wire:model="gl_func_classification" class="form-control">
                            @error('gl_func_classification') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Title of Project or Expense Classification</label>
                            <input type="text" wire:model="gl_project_title" class="form-control">
                            @error('gl_project_title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" wire:model="gl_date" class="form-control">
                            @error('gl_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Voucher No.</label>
                            <input type="number" wire:model="gl_vouchernum" class="form-control">
                            @error('gl_vouchernum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Particulars</label>
                            <input type="text" wire:model="gl_particulars" class="form-control">
                            @error('gl_particulars') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Balance Debit</label>
                            <input type="number" wire:model="gl_balance_debit" class="form-control">
                            @error('gl_balance_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Debits</label>
                            <input type="number" wire:model="gl_debit" class="form-control">
                            @error('gl_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Credits</label>
                            <input type="number" wire:model="gl_credit" class="form-control">
                            @error('gl_credit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label> Credits Balance</label>
                            <input type="text" wire:model="gl_credit_balance" class="form-control">
                            @error('gl_credit_balance') <span class="text-danger">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="updateGeneralLedgerModal" tabindex="-1" aria-labelledby="updateGeneralLedgerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateGeneralLedgerModalLabel">Edit General Ledger Journal</h5>                    
                     <!-- X BUTTON -->
                     <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>                   
                </div>
                <form wire:submit.prevent="updateGeneralLedger">
                <div class="modal-body">
                        <div class="mb-3">
                            <label>Symbol</label>
                            <input type="number" wire:model="gl_symbol" class="form-control">
                            @error('gl_symbol') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Name of Fund or Account</label>
                            <input type="text" wire:model="gl_fundname" class="form-control">
                            @error('gl_fundname') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Functional Classification</label>
                            <input type="text" wire:model="gl_func_classification" class="form-control">
                            @error('gl_func_classification') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Title of Project or Expense Classification</label>
                            <input type="text" wire:model="gl_project_title" class="form-control">
                            @error('gl_project_title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" wire:model="gl_date" class="form-control">
                            @error('gl_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Voucher No.</label>
                            <input type="number" wire:model="gl_vouchernum" class="form-control">
                            @error('gl_vouchernum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Particulars</label>
                            <input type="text" wire:model="gl_particulars" class="form-control">
                            @error('gl_particulars') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Balance Debit</label>
                            <input type="number" wire:model="gl_balance_debit" class="form-control">
                            @error('gl_balance_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Debits</label>
                            <input type="number" wire:model="gl_debit" class="form-control">
                            @error('gl_debit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Credits</label>
                            <input type="number" wire:model="gl_credit" class="form-control">
                            @error('gl_credit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label> Credits Balance</label>
                            <input type="text" wire:model="gl_credit_balance" class="form-control">
                            @error('gl_credit_balance') <span class="text-danger">{{ $message }}</span> @enderror
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
<div wire:ignore.self class="modal fade" id="deleteGeneralLedgerModal" tabindex="-1" aria-labelledby="deleteGeneralLedgerLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteGeneralLedgerModalLabel">Delete General Ledger Journal</h5>
                    
                    <!-- X BUTTON -->
                    <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="destroyGeneralLedger">
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

    <!-- @frontend heree need onting editing sa UI -->
    <!-- Export Modal -->
    <div wire:ignore.self class="modal fade" id="exportGeneralLedgerModal" tabindex="-1" aria-labelledby="exportGeneralLedgerLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportCheckDisbursementJournalModalLabel">Export General Ledger Journal</h5>
                     <!-- X BUTTON -->
                     <button type="button" data-bs-dismiss="modal"  wire:click="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                    <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" wire:click="exportGl_CSV">Export CSV </button>
                    <button class="mr-2 text-blue-700 bg-blue-100 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 rounded-lg px-4 py-2.5 text-center inline-flex items-center" style="font-weight: bold;" wire:click="exportGL_XLSX">Export XLSX </button>

                </div>
            </div>
        </div>
    </div>

</div>