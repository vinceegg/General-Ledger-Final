<!-- resources/views/livewire/gjtrashed.blade.php -->
@extends('layouts.app') 

@section('content')
    <div class="container">
        <a href="{{ route('GJ') }}" class="btn btn-primary">Go to General Journal</a>
        @if($softDeletedData->count() > 0)
            <table class="table">
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
                        <th>Journal Column</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($softDeletedData as $item)
                        <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->gj_entrynum }}</td>
                                        <td>{{ $item->gj_entrynum_date }}</td>
                                        <td>{{ $item->gj_jevnum }}</td>
                                        <td>{{ $item->gj_particulars }}</td>
                                        <td>{{ $item->gj_particulars }}</td>
                                        <td>{{ $item->gj_debit }}</td>
                                        <td>{{ $item->gj_credit }}</td>
                                        <td>{{ $item->general_journal_col }}</td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteGeneralJournalModal" wire:click="deleteGeneralJournal({{ $general_journals->id }})" class="btn btn-danger">Delete</button>


                                {{-- <button wire:click="restoreGeneralJournal({{ $item->id }})" class="btn btn-success">Restore</button>   

                                 {{--  --}}
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