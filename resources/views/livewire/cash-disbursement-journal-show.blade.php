<div>
    @include('livewire.cash-disbursement-journal-modal')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('message'))
                        <h5 class="alert alert-success">{{ session('message') }}</h5>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Cash Disbursement Journal</h4>
                            <div class="mt-2">
                                    {{-- ITO YUNG SA SORT KORINNE NOTICE THIS OK --}}
                                    <label for="sortField" class="mr-2">Sort By:</label>                        
                                    <select wire:model="sortDirection" id="sortDirection" class="ml-2">
                                        <option value="asc">Oldest First</option>
                                        <option value="desc">Newest First</option>
                                    </select>
                                </div>
                                <div>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="form-group mb-0 me-2">
                                        <label for="date-range" class="mb-0"></label>
                                        <input type="month" id="date-range" wire:model="selectedMonth" class="form-control">
                                    </div>
                                    {{-- ITO SA EXPORT BUTTON TO HA GUMAGANA TO OK? --}}
                                    <div class="mt-3">
                                        <div class="mb-3">
                                            <input type="file" wire:model="file" class="custom-file-input" id="customFile">
                                        </div>
                                        <button class="btn btn-primary" wire:click="importCDJ">Import</button>
                                        <button class="btn btn-success" wire:click="exportCDJ">Export</button>
                                    </div>
                                <input type="search" wire:model="search" wire:keydown.enter="#" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#CashDisbursementJournalModal">
                                    Add New Entry
                                </button>
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-borderd table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Entry Number</th>
                                        <th>Date</th>
                                        <th>Reference/RD No.</th>
                                        <th>Accountable Officer</th>
                                        <th>JEV No.</th>
                                        <th>Account Code</th>
                                        <th>Amount</th>
                                        <th>5-02-99-990</th>
                                        <th>5-02-02-010</th>
                                        <th>Account Code</th>
                                        <th>PR</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cash_disbursement_journal as $cash_disbursement_journals)
                                    <tr>
                                        <td>{{ $cash_disbursement_journals-> id }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_entrynum }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_entrynum_date }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_referencenum }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_accountable_officer}}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_jevnum }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_accountcode }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_amount }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_account1 }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_account2 }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_sundry_accountcode }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_pr }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_debit }}</td>
                                        <td>{{ $cash_disbursement_journals-> cdj_credit}}</td>
                                       
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateCashDisbursementJournalModal" wire:click="editCashDisbursementJournal({{ $cash_disbursement_journals->id}})" class="btn btn-primary"> 
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteCashDisbursementJournalModal" wire:click="deleteCashDisbursementJournal({{ $cash_disbursement_journals->id  }})" class="btn btn-danger">Delete</button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#softDeleteCashDisbursementJournalModal" wire:click="softDeleteCashDisbursementJournal({{ $cash_disbursement_journals->id }})" class="btn btn-warning">
                                                    Delete
                                                </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Record Found</td>
                                    </tr>
                                @endforelse                                
                            </tbody>
                        </table>
                        <button wire:click="GoToCashDisbursementJournalTrashed" class="btn text-green-500" style="background-color: #A2F5C4;">
                                Go to Soft Deleted Data
                            </button>
                        <div>
                            {{ $cash_disbursement_journal->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </div>