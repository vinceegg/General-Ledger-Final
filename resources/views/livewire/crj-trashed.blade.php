<!-- resources/views/livewire/crj-trashed.blade.php -->
@extends('layouts.app1') 

@section('content')
    <div class="container">
        <a href="{{ route('CRJ') }}" class="btn btn-primary">Go to Cash Receipt Journal</a>
        @if($softDeletedData->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                            <th>ID</th>
                            <th>Entry Number</th>
                            <th>Date</th>
                            <th>JEV No.</th>
                            <th>Payor</th>
                            <th>Collection Debit</th>
                            <th>Collection Credit</th>
                            <th>Deposit Debit</th>
                            <th>Deposit Credit</th>
                            <th>Account Code</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($softDeletedData as $item)
                        <tr>
                            <td>{{ $item-> id }}</td>
                            <td>{{ $item-> crj_entrynum}}</td>
                            <td>{{ $item-> crj_entrynum_date}}</td>
                            <td>{{ $item-> crj_jevnum}}</td>
                            <td>{{ $item-> crj_payor}}</td>
                            <td>{{ $item-> crj_collection_debit}}</td>
                            <td>{{ $item-> crj_collection_credit}}</td>
                            <td>{{ $item-> crj_deposit_debit}}</td>
                            <td>{{ $item-> crj_deposit_credit}}</td>
                            <td>{{ $item-> crj_accountcode}}</td>
                            <td>{{ $item-> crj_debit}}</td>
                            <td>{{ $item-> crj_credit}}</td>
                            <td>
                                {{-- <button wire:click="restoreCashReceiptJournal({{ $item->id }})" class="btn btn-success">Restore</button>                                               --}}
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