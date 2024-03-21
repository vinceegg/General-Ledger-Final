<?php

namespace App\Livewire;

use App\Exports\GeneralLedgerExport;
use App\Imports\GeneralLedgerImport;
use Livewire\WithPagination;
use App\Models\GeneralLedgerModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class GeneralLedgerShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $gl_entrynum,
    $gl_symbol,
    $gl_fundname,
    $gl_func_classification,
    $gl_project_title,
    $gl_date,
    $gl_vouchernum,
    $gl_particulars,
    $gl_balance_debit,
    $gl_debit,
    $gl_credit,
    $gl_credit_balance;

    public $search;
    public $general_ledger_id;
    public $selectedMonth;
    public $sortField = 'gl_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $softDeletedData;
    public $file;

    protected function rules()
    {
        return [
            'gl_entrynum'=>'required|integer',
            'gl_symbol'=>'nullable|integer',
            'gl_fundname'=>'nullable|string',
            'gl_func_classification'=>'nullable|string',
            'gl_project_title'=>'nullable|string',
            'gl_date'=>'nullable|date',
            'gl_vouchernum'=>'nullable|integer',
            'gl_particulars'=>'nullable|string',
            'gl_balance_debit'=> 'nullable|numeric',
            'gl_debit'=> 'nullable|numeric',
            'gl_credit'=> 'nullable|numeric',
            'gl_credit_balance'=> 'nullable|numeric',

        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveGeneralLedger()
    {
        $validatedData = $this->validate();

        GeneralLedgerModel::create($validatedData);
        session()->flash('message', 'Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }


    public function editGeneralLedger($general_ledger_id)
    {
        $general_ledger = GeneralLedgerModel::find($general_ledger_id);
        if ($general_ledger) {
            
            $this->general_ledger_id = $general_ledger->id;
            $this->gl_entrynum = $general_ledger->gl_entrynum;
            $this->gl_symbol = $general_ledger->gl_symbol;
            $this->gl_fundname = $general_ledger->gl_fundname;
            $this->gl_func_classification = $general_ledger->gl_func_classification;
            $this->gl_project_title = $general_ledger->gl_project_title;
            $this->gl_date = $general_ledger->gl_date;
            $this->gl_vouchernum = $general_ledger->gl_vouchernum;
            $this->gl_particulars = $general_ledger->gl_particulars;
            $this->gl_balance_debit = $general_ledger->gl_balance_debit;
            $this->gl_debit = $general_ledger->gl_debit;
            $this->gl_credit = $general_ledger->gl_credit;
            $this->gl_credit_balance = $general_ledger->gl_credit_balance;
        } 
        else {
            return redirect() -> to('/general_ledger'); 
        }
    }

    public function updateGeneralLedger()
    {
        $validatedData = $this->validate();

        GeneralLedgerModel::where('id', $this->general_ledger_id)->update([
            'gl_entrynum' => $validatedData['gl_entrynum'],
            'gl_symbol' => $validatedData['gl_symbol'],
            'gl_fundname' => $validatedData['gl_fundname'],
            'gl_func_classification' => $validatedData['gl_func_classification'],
            'gl_project_title' => $validatedData['gl_project_title'],
            'gl_date' => $validatedData['gl_date'],
            'gl_vouchernum' => $validatedData['gl_vouchernum'],
            'gl_particulars' => $validatedData['gl_particulars'],
            'gl_balance_debit' => $validatedData['gl_balance_debit'],
            'gl_debit' => $validatedData['gl_debit'],
            'gl_credit' => $validatedData['gl_credit'],
            'gl_credit_balance' => $validatedData['gl_credit_balance'],
        ]);
        session()->flash('message', 'Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteGeneralLedger($general_ledger_id)
    {
        $this->general_ledger_id = $general_ledger_id;
    }

    public function destroyGeneralLedger()
    {
        GeneralLedgerModel::find($this->general_ledger_id)->delete();
        session()->flash('message', 'Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function resetInput()
    {
            $this->general_ledger_id = '';
            $this->gl_entrynum = '';
            $this->gl_symbol = '';
            $this->gl_fundname = '';
            $this->gl_func_classification = '';
            $this->gl_project_title = '';
            $this->gl_date = '';
            $this->gl_vouchernum = '';
            $this->gl_particulars = '';
            $this->gl_balance_debit = '';
            $this->gl_debit = '';
            $this->gl_credit = '';
            $this->gl_credit_balance = '';
    }

    //ITO NA YUNG DINAGSAG KO 
    // Soft delete GeneralJournal
    public function softDeleteGeneralLedger($general_ledger_id)
    {
        $general_ledger= GeneralLedgerModel::find($general_ledger_id);
        if ( $general_ledger) {
            $general_ledger->delete();
            session()->flash('message', 'Soft Deleted Successfully');
    }
    
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    //PATI TO
    // View soft deleted GeneralJournals
    public function trashedGeneralLedger()
    {
        $this->softDeletedData = GeneralLedgerModel::onlyTrashed()->get();
        return view('livewire.g-l-trashed', ['softDeletedData' => $this->softDeletedData]);
    }

    public function GoToGeneralLedgerTrashed()
    {
        return redirect()->route('general-ledger.trashedGeneralLedger');
    }

    // Sorting logic SA SORT TO KORINNE HA
    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function importGL()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new GeneralLedgerImport, $filePath);

        return redirect()->back();
        }
    }

    public function importViewCKDJ(){
        return view('journals.LS');
    }
    
    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function exportGL() 
    {
        return Excel::download(new GeneralLedgerExport, 'Ledger Sheet.xlsx');
    }

    // public function restoreGeneralLedger($general_ledger_id)
    // {
    //     GeneralLedgerModel::where($general_ledger_id)->restore();
    //     session()->flash('message', 'Restored Successfully');
    // }

    public function searchAction()
    {
        // This method will be triggered when the Enter key is pressed.
        // Since it's just a placeholder, you don't need to add any code here.
    }

    public function sortAction()
    {
        // This method will be triggered when the Enter key is pressed.
        // Since the sorting is already handled by the sortBy method, you don't need to add any code here.
    }

    public function sortDate()
    {
        // This method will be triggered when the Enter key is pressed.
        // Since the sorting is already handled by the sortBy method, you don't need to add any code here.
    }

    // Render the component
    public function render()
    {
        $query = GeneralLedgerModel::query();

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('gl_date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        $query->where('id', 'like', '%' . $this->search . '%');

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        // Get paginated results
        $general_ledger = $query->orderBy('id', 'ASC')->paginate(10);

        return view('livewire.general-ledger-show',['general_ledger' => $general_ledger]);
    }
}