<?php

namespace App\Livewire;

use Livewire\Component;

class PageSelector extends Component
{
    public $selectedPage;
    public $showDropdown_journal = false;
    public $showDropdown_ledger = false;
    public $pages =[
        ['pageName' => 'Check Disbursement', 'url' => 'CKDJ', 'group' => 'journals'] ,
        ['pageName' => 'Cash Disbursement', 'url' => 'CDJ', 'group' => 'journals'] ,
        ['pageName' => 'Cash Receipt', 'url' => 'CRJ', 'group' => 'journals'] ,
        ['pageName' => 'General Journal', 'url' => 'GJ', 'group' => 'journals'],
        ['pageName' => 'Ledger Sheet', 'url' => 'LS','group' => 'ledger'],
       
        ];

        public function toggleDropdown_journal(){
            $this->showDropdown_journal = !$this->showDropdown_journal;

        }

        public function toggleDropdown_ledger(){
            $this->showDropdown_ledger = !$this->showDropdown_ledger;

        }
        

        public function redirectToPage()
        {
            if ($this->selectedPage) {
                return redirect('/' . $this->selectedPage);
            }
        }
    
    public function render()
    {
        return view('livewire.page-selector');
    }
}