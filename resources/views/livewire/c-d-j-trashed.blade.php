<!-- resources/views/livewire/crj-trashed.blade.php -->
@extends('layouts.app1') 

@section('content')
    <div class="container">
        <a href="{{ route('CDJ') }}" class="btn btn-primary">Go to Cash Disbursement Journal</a>
        @if($softDeletedData->count() > 0)
            <table class="table">
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
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($softDeletedData as $item)
                        <tr>
                                    <td>{{ $item-> id }}</td>
                                    <td>{{ $item-> cdj_entrynum }}</td>
                                    <td>{{ $item-> cdj_entrynum_date }}</td>
                                    <td>{{ $item-> cdj_referencenum }}</td>
                                    <td>{{ $item-> cdj_accountable_officer}}</td>
                                    <td>{{ $item-> cdj_jevnum }}</td>
                                    <td>{{ $item-> cdj_accountcode }}</td>
                                    <td>{{ $item-> cdj_amount }}</td>
                                    <td>{{ $item-> cdj_account1 }}</td>
                                    <td>{{ $item-> cdj_account2 }}</td>
                                    <td>{{ $item-> cdj_sundry_accountcode }}</td>
                                    <td>{{ $item-> cdj_pr }}</td>
                                    <td>{{ $item-> cdj_debit }}</td>
                                    <td>{{ $item-> cdj_credit}}</td>
                            <td>
                                {{-- <button wire:click="restoreCashDisbursementJournal({{ $item->id }})" class="btn btn-success">Restore</button>                                               --}}
                            </td>                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No soft deleted data found.</p>
        @endif
    </div>
@endsection