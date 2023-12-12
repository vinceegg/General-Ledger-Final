<div>
    @include('livewire.general-ledger-modal')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('message'))
                        <h5 class="alert alert-success">{{ session('message') }}</h5>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>General Ledger</h4>
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
                                        <button class="btn btn-primary" wire:click="importGL">Import</button>
                                        <button class="btn btn-success" wire:click="exportGL">Export</button>
                                    </div>
                                <input type="search" wire:model="search" wire:keydown.enter="#" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#GeneralLedgerModal">
                                    Add New Entry
                                </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderd table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Entry Number</th>
                                        <th>Symbol</th>
                                        <th>Name of Fund or Account</th>
                                        <th>Functional Classification</th>
                                        <th>Title of Project or Expense Classification</th>
                                        <th>Date</th>
                                        <th>Voucher No.</th>
                                        <th>Particulars</th>
                                        <th>Balance Debit</th>
                                        <th>Debits</th>
                                        <th>Credits</th>
                                        <th>Credits Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($general_ledger as $general_ledgers)
                                    <tr>
                                        
                                        <td>{{ $general_ledgers-> id }}</td>
                                        <td>{{ $general_ledgers-> gl_entrynum}}</td>
                                        <td>{{ $general_ledgers-> gl_symbol}}</td>
                                        <td>{{ $general_ledgers-> gl_fundname}}</td>
                                        <td>{{ $general_ledgers-> gl_func_classification}}</td>
                                        <td>{{ $general_ledgers-> gl_project_title}}</td>
                                        <td>{{ $general_ledgers-> gl_date}}</td>
                                        <td>{{ $general_ledgers-> gl_vouchernum}}</td>
                                        <td>{{ $general_ledgers-> gl_particulars}}</td>
                                        <td>{{ $general_ledgers-> gl_balance_debit}}</td>
                                        <td>{{ $general_ledgers-> gl_debit}}</td>
                                        <td>{{ $general_ledgers-> gl_credit}}</td>
                                        <td>{{ $general_ledgers-> gl_credit_balance}}</td>
                                                                    
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateGeneralLedgerModal" wire:click="editGeneralLedger({{ $general_ledgers->id}})" class="btn btn-primary"> 
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteGeneralLedgerModal" wire:click="deleteGeneralLedger({{ $general_ledgers->id  }})" class="btn btn-danger">Delete</button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#softDeleteGeneralLedgerModal" wire:click="softDeleteGeneralLedger({{ $general_ledgers->id }})" class="btn btn-warning">
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
                        <button wire:click="GoToGeneralLedgerTrashed" class="btn text-green-500" style="background-color: #A2F5C4;">
                                Go to Soft Deleted Data
                            </button>
                           
                        <div>
                            {{ $general_ledger->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>