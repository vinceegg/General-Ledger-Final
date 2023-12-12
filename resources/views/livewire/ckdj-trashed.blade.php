<!-- resources/views/livewire/crj-trashed.blade.php -->
@extends('layouts.app1') 

@section('content')
    <div class="container">
        <a href="{{ route('CKDJ') }}" class="btn btn-primary">Go to Check Disbursement Journal</a>
        @if($softDeletedData->count() > 0)
            <table class="table">
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
                            <td>{{ $item-> ckdj_entrynum}}</td>
                            <td>{{ $item-> ckdj_entrynum_date}}</td>
                            <td>{{ $item-> ckdj_checknum}}</td>
                            <td>{{ $item-> ckdj_payee}}</td>
                            <td>{{ $item-> ckdj_bur}}</td>
                            <td>{{ $item-> ckdj_cib_lcca}}</td>
                            <td>{{ $item-> ckdj_account1}}</td>
                            <td>{{ $item-> ckdj_account2}}</td>
                            <td>{{ $item-> ckdj_account3}}</td>
                            <td>{{ $item-> ckdj_salary_wages}}</td>
                            <td>{{ $item-> ckdj_honoraria}}</td>
                            <td>{{ $item-> ckdj_sundry_accountcode}}</td>
                            <td>{{ $item-> ckdj_debit}}</td>
                            <td>{{ $item-> ckdj_credit}}</td>
                            
                            <td>
                                {{-- <button wire:click="restoreCheckDisbursementJournal({{ $item->id }})" class="btn btn-success">Restore</button>                                               --}}
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