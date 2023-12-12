
@extends('layouts.app1') 

@section('content')
    <div class="container">
        <a href="{{ route('LS') }}" class="btn btn-primary">Go to Ledger Sheet</a>
        @if($softDeletedData->count() > 0)
            <table class="table">
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
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($softDeletedData as $item)
                        <tr>
                                    <td>{{ $item-> id }}</td>
                                    <td>{{ $item-> gl_entrynum}}</td>
                                    <td>{{ $item-> gl_symbol}}</td>
                                    <td>{{ $item-> gl_fundname}}</td>
                                    <td>{{ $item-> gl_func_classification}}</td>
                                    <td>{{ $item-> gl_project_title}}</td>
                                    <td>{{ $item-> gl_date}}</td>
                                    <td>{{ $item-> gl_vouchernum}}</td>
                                    <td>{{ $item-> gl_particulars}}</td>
                                    <td>{{ $item-> gl_balance_debit}}</td>
                                    <td>{{ $item-> gl_debit}}</td>
                                    <td>{{ $item-> gl_credit}}</td>
                                    <td>{{ $item-> gl_credit_balance}}</td>
                            
                            <td>
                                {{-- <button wire:click="restoreGeneralLedger({{ $item->id }})" class="btn btn-success">Restore</button>                                               --}}
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