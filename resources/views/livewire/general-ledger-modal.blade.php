
<div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="GeneralLedgerModal" tabindex="-1" aria-labelledby="GeneralLedgerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="GeneralLedgerModalLabel">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="saveGeneralLedger">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Entry Number</label>
                            <input type="number" wire:model="gl_entrynum" class="form-control">
                            @error('gl_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
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
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
                    <h5 class="modal-title" id="updateGeneralLModalLabel">Edit General Ledger Journal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateGeneralLedger">
                <div class="modal-body">
                        <div class="mb-3">
                            <label>Entry Number</label>
                            <input type="number" wire:model="gl_entrynum" class="form-control">
                            @error('gl_entrynum') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
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
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="GeneralLedgerModal" tabindex="-1" aria-labelledby="deleteGeneralLedger"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteGeneralLedgerModalLabel">Delete General Ledger Journal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyGeneralLedger">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes! Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>