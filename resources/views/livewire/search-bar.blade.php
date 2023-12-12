<div>
    <input wire:model="search" wire:keydown.enter="displayResult" type="text" placeholder="Search...">
    
    @if ($search !== '')
        @forelse($results as $result)
            <h3 wire:click="redirectToResult('{{ $result->tablename }}')">
                <i>"{{ $search }}"</i> from {{ $result->tablename }}
            </h3> 
            <li wire:click="redirectToResult('{{ $result->tablename }}')">
                <u>{{ $result->search_column }}</u>
            </li>
            <div>
                <!-- Additional content related to each result -->
            </div>
        @empty
            <h3>No matches found.</h3>
        @endforelse
    @endif
</div>