<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class DashboardCalendar extends Component
{

    public $date; 

    public function mount($date = null)
    {
        $this->date = Carbon::today();
        if ($date) {
            $this->date = Carbon::parse($date);
        }
    }

    public function previousMonth()
    {
        $this->date = $this->date->subMonth();
    }
    public function nextMonth()
    {
        $this->date = $this->date->addMonth();
    }


    public function render()
    {
        return view('livewire.dashboard-calendar');
    }
}