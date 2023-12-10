<!-- resources/views/livewire/gjtrashed.blade.php -->
@extends('layouts.app1') 

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
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($softDeletedData as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->entrynumber }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->jevnumber }}</td>
                            <td>{{ $item->particulars }}</td>
                            <td>{{ $item->accountcode }}</td>
                            <td>{{ $item->debit }}</td>
                            <td>{{ $item->credit }}</td>
                            <td>{{ $item->Journalcol }}</td>
                            <td>
                                {{-- <button wire:click="restoreGeneralJournal({{ $item->id }})" class="btn btn-success">Restore</button>                                               --}}
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