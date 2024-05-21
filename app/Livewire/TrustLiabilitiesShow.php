<?php

namespace App\Livewire;

use App\Exports\TrustLiabilitiesExport;
use App\Imports\TrustLiabilitiesImport;
use App\Models\TrustLiabilitiesModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class TrustLiabilitiesShow extends Component
{
    use WithFileUploads;

    public 
    $gl_date,
    $gl_vouchernum,
    $gl_particulars,
    $gl_balance_debit,
    $gl_debit,
    $gl_credit,
    $gl_credit_balance,
    $deleteType; // Added deleteType property

    
    public $search;
    public $general_ledger_id;
    public $selectedMonth;
    public $sortField = 'id'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalBalanceDebit = 0;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalCreditBalance = 0;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message
    
    protected function rules()
    {
        return [
            'gl_date'=>'required|date',
            'gl_vouchernum'=>'nullable|string', //@vince yung data type inedit ko 
            'gl_particulars'=>'nullable|string', 
            'gl_balance_debit'=> 'nullable|numeric|min:0|max:100000000',
            'gl_debit'=> 'nullable|numeric|min:0|max:100000000',
            'gl_credit'=> 'nullable|numeric|min:0|max:100000000',
            'gl_credit_balance'=> 'nullable|numeric|min:0|max:100000000',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveGeneralLedger()
    {       
        $validatedData = $this->validate();

        // Convert empty strings to null
        foreach ($validatedData as $key => $value) {
            if ($value === '') {
                $validatedData[$key] = null;
            }
        }

        TrustLiabilitiesModel::create($validatedData);

        // Update notification state
        $this->notificationMessage = 'Added Successfully';
        $this->showNotification = true;

        $this->resetInput();

        $this->dispatch('notification-shown');

    }

    public function editGeneralLedger($general_ledger_id)
    {
        $general_ledger = TrustLiabilitiesModel::find($general_ledger_id);
        if ($general_ledger) {
            
            $this->general_ledger_id = $general_ledger->id;
            $this->gl_date = $general_ledger->gl_date;
            $this->gl_vouchernum = $general_ledger->gl_vouchernum;
            $this->gl_particulars = $general_ledger->gl_particulars;
            $this->gl_balance_debit = $general_ledger->gl_balance_debit;
            $this->gl_debit = $general_ledger->gl_debit;
            $this->gl_credit = $general_ledger->gl_credit;
            $this->gl_credit_balance = $general_ledger->gl_credit_balance;
        } 
 
    }

    public function updateGeneralLedger()
    {
        $validatedData = $this->validate();

        TrustLiabilitiesModel::where('id', $this->general_ledger_id)->update([
            'gl_date' => $validatedData['gl_date'],
            'gl_vouchernum' => $validatedData['gl_vouchernum'],
            'gl_particulars' => $validatedData['gl_particulars'],
            'gl_balance_debit' => $validatedData['gl_balance_debit'],
            'gl_debit' => $validatedData['gl_debit'],
            'gl_credit' => $validatedData['gl_credit'],
            'gl_credit_balance' => $validatedData['gl_credit_balance'],
        ]);
        // Update notification state
        $this->notificationMessage = 'Updated Successfully';
        $this->showNotification = true;
        $this->resetInput();

        // Dispatch browser event to handle notification visibility
        $this->dispatch('notification-shown');

        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->general_ledger_id = '';
        $this->gl_date = '';
        $this->gl_vouchernum = '';
        $this->gl_particulars = '';
        $this->gl_balance_debit = '';
        $this->gl_debit = '';
        $this->gl_credit = '';
        $this->gl_credit_balance = '';
    }

    //ITO NA YUNG DINAGSAG KO 
    // Soft delete GeneralLedger
    public function softDeleteGeneralLedger($general_ledger_id)
    {
        $general_ledger= TrustLiabilitiesModel::find($general_ledger_id);
        if ( $general_ledger) {
            $general_ledger->delete();
    }
        $this->resetInput();
        $this->dispatch('close-modal');
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
        Excel::import(new TrustLiabilitiesImport, $filePath);

        return redirect()->route('TrustLiabilities')->with('message', 'File Imported Successfully');
        }
    }

    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function exportGL_XLSX(Request $request) 
    {
        return Excel::download(new TrustLiabilitiesExport, 'Ledger Sheet.xlsx');
    }
    public function exportGl_CSV(Request $request) 
    {
        return Excel::download(new TrustLiabilitiesExport, 'Ledger Sheet.csv');
    }

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

    // Method to reset notification
    public function resetNotification()
    {
        $this->showNotification = false;
    }
    // Method to restore soft-deleted record
    public function restoreGeneralLedger($id)
    {
        $general_ledger = TrustLiabilitiesModel::onlyTrashed()->find($id);
        if ($general_ledger) {
            $general_ledger->restore();
            session()->flash('message', 'Record restored successfully.');
        }
    }

    // Render the component
    public function render()
    {
        $query = TrustLiabilitiesModel::query();

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('gl_date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        // Add the search filter
        //@vince eto edited function sa search
        $query->where(function ($q) {
            $q ->where('id', 'like', '%' . $this->search . '%')
            ->orWhere('gl_date', 'like', '%' . $this->search . '%')
            ->orWhere('gl_vouchernum', 'like', '%' . $this->search . '%')
            ->orWhere('gl_particulars', 'like', '%' . $this->search . '%')
            ->orWhere('gl_balance_debit', 'like', '%' . $this->search . '%')
            ->orWhere('gl_debit', 'like', '%' . $this->search . '%')
            ->orWhere('gl_credit', 'like', '%' . $this->search . '%')
            ->orWhere('gl_credit_balance', 'like', '%' . $this->search . '%');
        });

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $trust_liabilities = $query->orderBy('id', 'ASC')->get(); // Changed from paginate() to get()

        // Calculate the total balance, debit, and credit
        $this->totalBalanceDebit = $query->sum('gl_balance_debit');
        $this->totalDebit = $query->sum('gl_debit');
        $this->totalCredit = $query->sum('gl_credit');
        $this->totalCreditBalance = $query->sum('gl_credit_balance');

        return view('livewire.trust-liabilities-show',['general_ledger' => $trust_liabilities]);
    }
}
