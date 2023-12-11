<!-- Insert Modal -->

<div wire:ignore.self class="modal fade" id="generaljournalModal" tabindex="-1" aria-labelledby="generaljournalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generaljournalModalLabel">Add Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
                    
            </div>
            <form wire:submit.prevent="saveGeneralJournal">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Entry Number</label>
                        <input type="text" wire:model="entrynumber" class="form-control">
                        @error('entrynumber') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" wire:model="date" class="form-control">
                        @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Jev Number</label>
                        <input type="number" wire:model="jevnumber" class="form-control">
                        @error('jevnumber') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Particulars</label>
                        <input type="text" wire:model="particulars" class="form-control">
                        @error('particulars') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Account Code</label>
                        <input type="text" wire:model="accountcode" class="form-control">
                        @error('accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Debit</label>
                        <input type="number" wire:model="debit" class="form-control">
                        @error('debit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Credit</label>
                        <input type="number" wire:model="credit" class="form-control">
                        @error('credit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>General Journal Col</label>
                        <input type="text" wire:model="Journalcol" class="form-control">
                        @error('Journalcol') <span class="text-danger">{{ $message }}</span> @enderror
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
<div wire:ignore.self class="modal fade" id="updateGeneralJournalModal" tabindex="-1" aria-labelledby="updateGeneralJournalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateGeneralJournalModalLabel">Edit General Journal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateGeneralJournal">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Entry Number</label>
                        <input type="text" wire:model="entrynumber" class="form-control">
                        @error('entrynumber') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" wire:model="date" class="form-control">
                        @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Jev Number</label>
                        <input type="number" wire:model="jevnumber" class="form-control">
                        @error('jevnumber') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Particulars</label>
                        <input type="text" wire:model="particulars" class="form-control">
                        @error('particulars') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Account Code</label>
                        <input type="text" wire:model="accountcode" class="form-control">
                        @error('accountcode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Debit</label>
                        <input type="number" wire:model="debit" class="form-control">
                        @error('debit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Credit</label>
                        <input type="number" wire:model="credit" class="form-control">
                        @error('credit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>General Journal Col</label>
                        <input type="text" wire:model="Journalcol" class="form-control">
                        @error('Journalcol') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyGeneralJournal">
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