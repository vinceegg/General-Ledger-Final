<?php

namespace App\Livewire;

use App\Models\SearchModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SearchBar extends Component
{
    use WithPagination;

    public $search= '';
    public $results = [];
    public $selectedResult = null;

    public function displayResult()
{
    $this->results = DB::table('general_ledger')
        ->selectRaw('`gl_fundname` COLLATE utf8mb4_general_ci AS `search_column`, "faqs" AS `tablename`')
        ->where('gl_fundname', 'like', '%' . $this->search . '%')
        ->orWhere('gl_project_title', 'like', '%' . $this->search . '%')

        ->union(DB::table('check_disbursement_journal')
            ->selectRaw('`ckdj_payee` COLLATE utf8mb4_general_ci AS `search_column`, "check_disbursement_journal" AS `tablename`')
            ->where('ckdj_payee', 'like', '%' . $this->search . '%')
        )

        ->union(DB::table('cash_receipt_journal')
            ->selectRaw('`crj_payor` COLLATE utf8mb4_general_ci AS `search_column`, "cash_receipt_journal" AS `tablename`')
            ->where('crj_payor', 'like', '%' . $this->search . '%')
        )

        ->union(DB::table('cash_disbursement_journal')
            ->selectRaw('`cdj_accountable_officer` COLLATE utf8mb4_general_ci AS `search_column`, "cash_disbursement_journal" AS `tablename`')
            ->where('cdj_accountable_officer', 'like', '%' . $this->search . '%')
        )

        ->union(DB::table('general_journal')
            ->selectRaw('`gj_particulars` COLLATE utf8mb4_general_ci AS `search_column`, "general_journal" AS `tablename`')
            ->where('gj_particulars', 'like', '%' . $this->search . '%')
        )
        ->get();
}


    public function clearResults()
    {
        // Clear the results
        $this->search='';
        $this->results = [];
        $this->selectedResult = null;
    }

    

    public function redirectToResult($tableName)
    {
        // Implement your redirection logic here
        // You can use the `redirect` helper function to redirect to the specific page
        $this->selectedResult = $tableName;
        return redirect('/' . $tableName);
    }

    


    public function render()
    {
        return view('livewire.search-bar');
    }
}