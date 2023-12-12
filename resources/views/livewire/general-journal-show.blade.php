<div>
    @include('livewire.generaljournal-modal')
    
    {{-- <input type="search" wire:model="search" wire:keydown.enter="#" class="form-control mx-2" placeholder="Search..." style="width: 230px;"> --}}
    <input type="search" wire:model="search" wire:keydown.enter="search" class="form-control mx-2" placeholder="Search..." style="width: 230px;"> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
    wire:click="closeModal"></button>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>General Journal</h4>
                            <div class="mt-2">
                                {{-- ITO YUNG SA SORT KORINNE NOTICE THIS OK --}}
                                <label for="sortField" class="mr-2">Sort By:</label>                        
                                <select wire:model="sortDirection" id="sortDirection" class="ml-2">
                                    <option value="asc">Oldest First</option>
                                    <option value="desc">Newest First</option>
                                </select>
                            </div>
                            <div>
                                {{-- ITO SA EXPORT BUTTON TO HA GUMAGANA TO OK? --}}
                                <button wire:click="export" class="btn btn-success">Export</button>
                            </div>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="form-group mb-0 me-2">
                                    <label for="date-range" class="mb-0"></label>
                                    <input type="month" id="date-range" wire:model="selectedMonth" class="form-control">
                                </div>
                            
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#generaljournalModal">
                                    Add New Journal
                                </button>
                                
                            </div>                           
                        </div>                       
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Entry Number</th>
                                    <th>Date</th>
                                    <th>Jev Number</th>
                                    <th>Particulars</th>
                                    <th>Account Code</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>General Journal Col</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($general_journal as $general_journals)
                                    <tr>
                                        <td>{{ $general_journals->id }}</td>
                                        <td>{{ $general_journals->entrynumber }}</td>
                                        <td>{{ $general_journals->date }}</td>
                                        <td>{{ $general_journals->jevnumber }}</td>
                                        <td>{{ $general_journals->particulars }}</td>
                                        <td>{{ $general_journals->accountcode }}</td>
                                        {{-- <td>{{ $general_journals->debit }}</td>
                                        <td>{{ $general_journals->credit }}</td> --}}
                                        <td>{{ number_format($general_journals->debit, 2, '.', ',') }}</td>
                                        <td>{{ number_format($general_journals->credit, 2, '.', ',') }}</td>
                                        <td>{{ $general_journals->Journalcol }}</td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateGeneralJournalModal" wire:click="editGeneralJournal({{ $general_journals->id }})" class="btn btn-primary">
                                                Edit
                                            </button>
                                            {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#deleteGeneralJournalModal" wire:click="deleteGeneralJournal({{ $general_journals->id }})" class="btn btn-danger">Delete</button> --}}
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#softDeleteGeneralJournalModal" wire:click="softDelete({{ $general_journals->id }})" class="btn btn-warning">
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
                        <button onclick="window.location='{{ route('general-journal.trashed') }}'" class="btn text-green-500" style="background-color: #A2F5C4;">
                            Go to Soft Deleted Data
                        </button>
                        <div>
                            {{ $general_journal->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>