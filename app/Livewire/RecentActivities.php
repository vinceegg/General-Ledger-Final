<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ActivityLogModel;
use App\Models\User;
use Illuminate\Support\Str;



class RecentActivities extends Component
{

    public $activity_logs;

    public function mount()
    {
        $this->activity_logs = ActivityLogModel::latest()->take(6)->get();
    }

    public function formatRoute($description)
    {
        return Str::snake($description);
    }

    public function getUser($causerId)
    {
        return User::find($causerId);
    }

    public function render()
    {
        return view('livewire.recent-activities');
    }
}