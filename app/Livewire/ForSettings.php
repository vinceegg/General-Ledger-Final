<?php

namespace App\Livewire;

use Livewire\Component;

class ForSettings extends Component
{
    public $name = 'Mara Calinao';
    public $position = 'Accounting Officer';
    public $accessStatuses = [
        ['page' => 'CKDJ', 'status' => 'can view'],
        ['page' => 'CDJ', 'status' => 'can view'],
        ['page' => 'CRJ', 'status' => 'can view'],
        ['page' => 'GJ', 'status' => 'can view'],
        ['page' => 'GL', 'status' => 'can view']

    ];

    public function render()
    {
        return view('livewire.for-settings');
    }
}