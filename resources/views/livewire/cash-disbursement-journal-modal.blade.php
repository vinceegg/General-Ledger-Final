<div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="CashDisbursementJournalModal" tabindex="-1" aria-labelledby="CashDisbursementJournalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CashDisbursementJournalModalLabel">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
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
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
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
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyCashDisbursementJournal">
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
</div></div>