<div>
    @include('livewire.check-disbursement-journal-modal')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('message'))
                        <h5 class="alert alert-success">{{ session('message') }}</h5>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Check Disbursement Journal</h4>
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
                                        <button class="btn btn-primary" wire:click="importCKDJ">Import</button>
                                        <button class="btn btn-success" wire:click="exportCKDJ">Export</button>
                                    </div>
                                <input type="search" wire:model="search" wire:keydown.enter="#" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#CheckDisbursementJournalModal">
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
                                        <th>Check No.</th>
                                        <th>Payee</th>
                                        <th>BUR</th>
                                        <th>CIB-LCCA</th>
                                        <th>2-02-01-010-A</th>
                                        <th>2-02-01-010-B</th>
                                        <th>2-02-01-010-E</th>
                                        <th>Sal&Wages</th>
                                        <th>Honoraria</th>
                                        <th>Sundry Account Code</th> <!-- Updated label for clarity -->
                                        <th>Debit</th>
                                        <th>Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- VINCE LAGYAN MO NG SUNDRY -->
                                    @forelse ($check_disbursement_journal as $check_disbursement_journals)
                                    @forelse($check_disbursement_journals->sundries as $sundry)
                                        <tr>
                                            <!-- VINCE EDIT MO TO KADA JOURNAL -->
                                            <td>{{ $check_disbursement_journals->id }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_entrynum }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_entrynum_date }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_checknum }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_payee }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_bur }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_cib_lcca }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_account1 }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_account2 }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_account3 }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_salary_wages }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_honoraria }}</td>
    
                                            <!-- DITO KINUKUHA KADA LAMAN NG SUNDRY -->
                                            <td>{{ $sundry->ckdj_sundry_account_code }}</td>
                                            <td>{{ $sundry->ckdj_sundry_debit }}</td>
                                            <td>{{ $sundry->ckdj_sundry_credit }}</td>
                                        </tr>
                                    @empty
                                        <!-- Handle the case when there are no sundries -->
                                        <tr>
                                            <!-- Display the necessary columns for check_disbursement_journal -->
                                            <td>{{ $check_disbursement_journals->id }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_entrynum }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_entrynum_date }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_checknum }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_payee }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_bur }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_cib_lcca }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_account1 }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_account2 }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_account3 }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_salary_wages }}</td>
                                            <td>{{ $check_disbursement_journals->ckdj_honoraria }}</td>
    
                                            <!-- Empty cells for sundry information -->
                                            <td></td><td></td><td></td>
                                        </tr>
                                    @endforelse
    
                                    </td>
                                  <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateCheckDisbursementJournalModal" wire:click="editCheckDisbursementJournal({{ $check_disbursement_journals->id}})" class="btn btn-primary"> 
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteCheckDisbursementJournalModal" wire:click="deleteCheckDisbursementJournal({{ $check_disbursement_journals->id  }})" class="btn btn-danger">Delete</button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#softDeleteCheckDisbursementJournalModal" wire:click="softDeleteCheckDisbursementJournal({{ $check_disbursement_journals->id }})" class="btn btn-warning">
                                                    Delete
                                                </button>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Handle the case when there are no check_disbursement_journal records -->
                                    <tr>
                                        <td colspan="15">No records found.</td>
                                    </tr>
                                @endforelse
                                    
    
                                  
                                                               
                            </tbody>
                        </table>
                        <button wire:click="GoToCheckDisbursementJournalTrashed" class="btn text-green-500" style="background-color: #A2F5C4;">
                                Go to Soft Deleted Data
                            </button>
                        <div>
                            {{ $check_disbursement_journal->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>