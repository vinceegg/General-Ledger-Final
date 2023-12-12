<div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="CheckDisbursementJournalModal" tabindex="-1" aria-labelledby="CheckDisbursementJournalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CheckDisbursementJournalModalLabel">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
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



                        <!-- STEP 2: ETO SA PAG ADD NG BAGONG SUNDRY -->

                        <div class="add-input">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Account Code" wire:model="ckdj_sundry_account_code">
                                        @error('ckdj_sundry_account_code') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" wire:model="ckdj_sundry_debit" placeholder="Debit">
                                        @error('ckdj_sundry_debit') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" wire:model="ckdj_sundry_credit" placeholder="Credit">
                                        @error('ckdj_sundry_credit') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn text-white btn-info btn-sm" wire:click.prevent="add">Add</button>
                                </div>
                            </div>
                        </div>

                        @foreach($inputs as $key => $input)
                            <div class="add-input">
                                <div class="row">
                                    <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Account Code" wire:model="ckdj_sundry_account_code">
                                        @error('ckdj_sundry_account_code') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" wire:model="inputs.{{ $key }}.ckdj_sundry_debit" placeholder="Debit">
                                            @error('inputs.'.$key.'.ckdj_sundry_debit') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" wire:model="inputs.{{ $key }}.ckdj_sundry_credit" placeholder="Credit">
                                            @error('inputs.'.$key.'.ckdj_sundry_credit') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{ $key }})">Remove</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    

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
        <div wire:ignore.self class="modal fade" id="updateCheckDisbursementJournalModal" tabindex="-1" aria-labelledby="updateCheckDisbursementJournalModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateCheckDisbursementJournalModalLabel">Edit Check Disbursement Journal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                            aria-label="Close"></button>
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
                            <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyCheckDisbursementJournal">
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