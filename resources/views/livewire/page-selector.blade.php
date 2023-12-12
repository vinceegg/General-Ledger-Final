<!-- basically sidebar na 'tong buong component na to imbis na dropdown lang T.T -->




<div>
    <a href = "{{ url('/') }}">Home</a>
    <!-- dropdown icon -->
    <div>
        <label for="journal_dropdown">Journal</label>
        <span wire:click ="toggleDropdown_journal"><svg name="journal_dropdown" class="dropdown" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width = "15" height = "15">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg></span>    
    </div>

        @if ($showDropdown_journal)
            <div>
                @foreach($pages as $page)
                    @if($page['group'] == 'journals')
                        <a  wire:model="selectedPage" wire:change="redirectToPage" href="{{ $page['url'] }}" >{{ $page['pageName'] }}</a>
                        <br>
                    @endif
                @endforeach
            </div>
        @endif
    


    <div>
        <label for="ledger_dropdown">General Ledger</label>
        <span wire:click ="toggleDropdown_ledger"><svg name="ledger_dropdown" class="dropdown" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width = "15" height = "15">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg></span>    
    </div>

        @if ($showDropdown_ledger)
            <div>
                @foreach($pages as $page)
                    @if($page['group'] == 'ledger')
                        <a  wire:model="selectedPage" wire:change="redirectToPage" href="{{ $page['url'] }}" >{{ $page['pageName'] }}</a>
                        <br>
                    @endif
                @endforeach
            </div>
        @endif

        <a href = "{{ url('/faqs') }}">Help/FAQs</a><br>
        <a href = "{{ url('/settings') }}">Settings</a>
        <div>
            <form action="/logout" method="post">
                @csrf
                    <br>
                    <button  type="submit">Logout</button>
                </form>
            </div>

        
    


</div>