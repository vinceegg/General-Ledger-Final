<?php

namespace App\Livewire;

use App\Exports\InternetSubscriptionExpensesExport;
use App\Imports\InternetSubscriptionExpensesImport;
use App\Models\ledgerSheetModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class LedgerSheetShow extends Component
{
    use WithFileUploads;

    public 
    $ls_date,
    $ls_vouchernum,
    $ls_particulars,
    $ls_balance_debit,
    $ls_debit,
    $ls_credit,
    $ls_credit_balance,
    $deleteType; // Added deleteType property

    public $ls_accountname;
    public $ledger_sheet;
    public $search;
    public $general_ledger_id;
    public $selectedMonth;
    public $sortField = 'ls_id'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
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
            'ls_date'=>'required|date',
            'ls_vouchernum'=>'nullable|string', //@vince yung data type inedit ko 
            'ls_particulars'=>'nullable|string', 
            'ls_balance_debit'=> 'nullable|numeric|min:0|max:100000000',
            'ls_debit'=> 'nullable|numeric|min:0|max:100000000',
            'ls_credit'=> 'nullable|numeric|min:0|max:100000000',
            'ls_credit_balance'=> 'nullable|numeric|min:0|max:100000000',
            'ls_accountname' => ['required', 'string', Rule::in(['Cash Local Treasury', 'Accounts Receivable', 'Rent Income'])],
        ];
    }

    public function set_accountname($value)
    {
        $this->ls_accountname = $value;
    }

    // public function updated($fields)
    // {
    //     $this->validateOnly($fields);
    // }

    // public function saveGeneralLedger()
    // {       
    //     $validatedData = $this->validate();

    //     $validatedData['ls_accountname'] = $this->ls_accountname;

    //     // Convert empty strings to null
    //     foreach ($validatedData as $key => $value) {
    //         if ($value === '') {
    //             $validatedData[$key] = null;
    //         }
    //     }

    //     ledgerSheetModel::create($validatedData);

    //     // Update notification state
    //     $this->notificationMessage = 'Added Successfully';
    //     $this->showNotification = true;

    //     $this->resetInput();

    //     $this->dispatch('notification-shown');

    // }

    // public function editGeneralLedger($general_ledger_id)
    // {
    //     $general_ledger = ledgerSheetModel::find($general_ledger_id);
    //     if ($general_ledger) {
            
    //         $this->general_ledger_id = $general_ledger->ls_id;
    //         $this->ls_date = $general_ledger->ls_date;
    //         $this->ls_vouchernum = $general_ledger->ls_vouchernum;
    //         $this->ls_particulars = $general_ledger->ls_particulars;
    //         $this->ls_balance_debit = $general_ledger->ls_balance_debit;
    //         $this->ls_debit = $general_ledger->ls_debit;
    //         $this->ls_credit = $general_ledger->ls_credit;
    //         $this->ls_credit_balance = $general_ledger->ls_credit_balance;
    //     } 
    // }

    // public function updateGeneralLedger()
    // {
    //     $validatedData = $this->validate();

    //     ledgerSheetModel::where('ls_id', $this->general_ledger_id)->update([
    //         'ls_date' => $validatedData['ls_date'],
    //         'ls_vouchernum' => $validatedData['ls_vouchernum'],
    //         'ls_particulars' => $validatedData['ls_particulars'],
    //         'ls_balance_debit' => $validatedData['ls_balance_debit'],
    //         'ls_debit' => $validatedData['ls_debit'],
    //         'ls_credit' => $validatedData['ls_credit'],
    //         'ls_credit_balance' => $validatedData['ls_credit_balance'],
    //     ]);
    //     // Update notification state
    //     $this->notificationMessage = 'Updated Successfully';
    //     $this->showNotification = true;
    //     $this->resetInput();

    //     // Dispatch browser event to handle notification visibility
    //     $this->dispatch('notification-shown');

    //     $this->dispatch('close-modal');
    // }

    // public function closeModal()
    // {
    //     $this->resetInput();
    // }

    // public function resetInput()
    // {
    //     $this->general_ledger_id = '';
    //     $this->ls_date = '';
    //     $this->ls_vouchernum = '';
    //     $this->ls_particulars = '';
    //     $this->ls_balance_debit = '';
    //     $this->ls_debit = '';
    //     $this->ls_credit = '';
    //     $this->ls_credit_balance = '';
    // }

    // //ITO NA YUNG DINAGSAG KO 
    // // Soft delete GeneralLedger
    // public function softDeleteGeneralLedger($general_ledger_id)
    // {
    //     $general_ledger= ledgerSheetModel::find($general_ledger_id);
    //     if ( $general_ledger) {
    //         $general_ledger->delete();
    // }
    //     $this->resetInput();
    //     $this->dispatch('close-modal');
    // }

    // // Sorting logic SA SORT TO KORINNE HA
    // public function sortBy($field)
    // {
    //     if ($this->sortField == $field) {
    //         $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    //     } else {
    //         $this->sortField = $field;
    //         $this->sortDirection = 'asc';
    //     }
    // }

    // public function importGL()
    // {
    // // Ensure that a file has been uploaded
    //     if ($this->file) {
    //     $filePath = $this->file->store('files');
    //     Excel::import(new InternetSubscriptionExpensesImport, $filePath);

    //     return redirect()->route('InternetSubscriptionExpenses')->with('message', 'File Imported Successfully');
    //     }
    // }

    // //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    // public function exportGL_XLSX(Request $request) 
    // {
    //     return Excel::download(new InternetSubscriptionExpensesExport, 'Ledger Sheet.xlsx');
    // }
    // public function exportGl_CSV(Request $request) 
    // {
    //     return Excel::download(new InternetSubscriptionExpensesExport, 'Ledger Sheet.csv');
    // }

    // public function searchAction()
    // {
    //     // This method will be triggered when the Enter key is pressed.
    //     // Since it's just a placeholder, you don't need to add any code here.
    // }

    // public function sortAction()
    // {
    //     // This method will be triggered when the Enter key is pressed.
    //     // Since the sorting is already handled by the sortBy method, you don't need to add any code here.
    // }

    // public function sortDate()
    // {
    //     // This method will be triggered when the Enter key is pressed.
    //     // Since the sorting is already handled by the sortBy method, you don't need to add any code here.
    // }

    // Method to reset notification
    public function resetNotification()
    {
        $this->showNotification = false;
    }

    // Render the component
    // public function render()
    // {
    //     $query = ledgerSheetModel::query();

    //     // Apply the month filter if a month is selected
    //     if ($this->selectedMonth) {
    //         $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
    //         $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
    //         $query->whereBetween('ls_date', [$startOfMonth, $endOfMonth]);
    //     }

    //     // Add the search filter
    //     // Add the search filter
    //     //@vince eto edited function sa search
    //     $query->where(function ($q) {
    //         $q ->where('ls_id', 'like', '%' . $this->search . '%')
    //         ->orWhere('ls_date', 'like', '%' . $this->search . '%')
    //         ->orWhere('ls_vouchernum', 'like', '%' . $this->search . '%')
    //         ->orWhere('ls_particulars', 'like', '%' . $this->search . '%')
    //         ->orWhere('ls_balance_debit', 'like', '%' . $this->search . '%')
    //         ->orWhere('ls_debit', 'like', '%' . $this->search . '%')
    //         ->orWhere('ls_credit', 'like', '%' . $this->search . '%')
    //         ->orWhere('ls_credit_balance', 'like', '%' . $this->search . '%');
    //     });

    //     // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
    //     $query->orderBy($this->sortField , $this->sortDirection);

    //     $internet_subscription_expenses = $query->orderBy('id', 'ASC')->get(); // Changed from paginate() to get()

    //     // Calculate the total balance, debit, and credit
    //     $this->totalBalanceDebit = $query->sum('ls_balance_debit');
    //     $this->totalDebit = $query->sum('ls_debit');
    //     $this->totalCredit = $query->sum('ls_credit');
    //     $this->totalCreditBalance = $query->sum('ls_credit_balance');

    //     return view('livewire.internet-subscription-expenses-show',['general_ledger' => $internet_subscription_expenses]);
    // }

    public function fetchGeneralLedgerData()
    {
        // Check if ls_accountname is set
        if ($this->ls_accountname) {
            // Fetch general ledger data filtered by ls_accountname
            $this->ledger_sheet = ledgerSheetModel::where('ls_accountname', $this->ls_accountname)->get(); and year is 2024
        } else {
            // If ls_accountname is not set, fetch all general ledger data
            $this->ledger_sheet = ledgerSheetModel::all();
        }
    }

    // public function calculatetotalsperYear()
    // {
    //     calculate totals ng cash local treasury this month
    //     save sa database
    // }

    // public function calculatetotalsperMonth()
    // {
    //     calculate totals ng cash local treasury this year
    //     save sa database
    // }


    public function render()
    {
        // Call fetchGeneralLedgerData method to fetch data
        $this->fetchGeneralLedgerData();

        // Return view with general ledger data
        return view('livewire.ledger-sheet-show', [
            'ledger_sheet' => $this->ledger_sheet,
        ]);

        // return view('livewire.ledger-sheet-show');
    }
}
