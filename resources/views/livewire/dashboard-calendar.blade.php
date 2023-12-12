<div>
    <div class="px-2 py-1 flex w-full">
        <div wire:click.prefetch="previousMonth()" class="w-1/6 text-left hover:text-gray-900 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-left">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </div>

        <div class="w-4/6 font-bold text-center">
            {{ $date->format('F Y') }}
        </div>

        <div wire:click.prefetch="nextMonth()" class="w-1/6 text-right hover:text-gray-900 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 float-right">
              <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <div class="flex flex-wrap text-l text-center transition" wire:loading.class="opacity-20">

        <div class="flex w-full py-2">
            <div style="width: 14.28%; height: 60px;">Su</div>
            <div style="width: 14.28%; height: 60px;">Mo</div>
            <div style="width: 14.28%; height: 60px;">Tu</div>
            <div style="width: 14.28%; height: 60px;">We</div>
            <div style="width: 14.28%; height: 60px;">Th</div>
            <div style="width: 14.28%; height: 60px;">Fr</div>
            <div style="width: 14.28%; height: 60px;">Sa</div>
        </div>

        @php
            $startdate = $date->clone()->startOfMonth()->startOfWeek()->subDay();
            $enddate = $date->clone()->endOfMonth()->endOfWeek()->subDay();
            $loopdate = $startdate->clone();
            $month = $date->clone();
        @endphp

        @while ($loopdate < $enddate)
            <div style="width: 14.28%; height: 60px;"
                 class="h-10 hover:font-bold
                     @if ($loopdate->format('Y-m-d') === now()->format('Y-m-d'))
                         bg-blue-200 rounded-full
                     @elseif ($loopdate < $month->startOfMonth() || $loopdate > $month->endOfMonth())
                         opacity-50
                     @endif
                     ">
                {{ $loopdate->format('j') }}
            </div>
            @php($loopdate->addDay())
        @endwhile
    </div>
</div>