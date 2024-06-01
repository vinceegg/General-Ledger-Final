<?php

namespace App\Livewire;

use App\Exports\ledgerSheetExport;
use App\Imports\ledgerSheetImport;
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
    public $search = '';
    public $selectedMonth;
    public $sortField = 'ls_vouchernum'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalBalanceDebit = 0;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalCreditBalance = 0;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message
    public $query;

    
    

    
    protected function rules()
    {
        return [
            'ls_date'=>'nullable|date',
            'ls_vouchernum'=>'required|string|max:255', //@vince yung data type inedit ko 
            'ls_particulars'=>'nullable|string', 
            'ls_balance_debit'=> 'nullable|numeric|min:0|max:100000000',
            'ls_debit'=> 'nullable|numeric|min:0|max:100000000',
            'ls_credit'=> 'nullable|numeric|min:0|max:100000000',
            'ls_credit_balance'=> 'nullable|numeric|min:0|max:100000000',
            'ls_accountname' => ['required', 'string', Rule::in([ '1 01 01 010 - Cash Local Treasury',
            '1 01 01 020 - Petty Cash',
            '1 01 02 010 - Cash in Bank Local Currency Current Account',
            '1 02 01 010 - Cash in Bank Local Currency Time Deposits',
            '1 03 01 010 - Accounts Receivable',
            '1 03 01 070 - Interests Receivable',
            '1 07 05 020 - Office Equipment',
            '1 07 05 021 - Accumulated Depreciation Office Equipment',
            '1 07 05 030 - Info and Communication Technology Equipment',
            '1 07 05 031 - Accumulated Depreciation ICT Equipment',
            '1 07 05 090 - Disaster Response and Rescue Equipment',
            '1 07 05 091 - Acc Depreciation Disaster Response and Rescue Equipment',
            '1 07 05 100 - Military Police Security Equipment',
            '1 07 05 101 - Acc Depreciation Military Police Security Eqpmnt',
            '1 07 05 110 - Medical Equipment',
            '1 07 05 111 - Accumulated Depreciation Medical Equipment',
            '1 07 05 130 - Sports Equipment',
            '1 07 05 131 - Accumulated Depreciation Sports Equipment',
            '1 07 05 140 - Technical and Scientific Equipment',
            '1 07 05 141 - Acc Depreciation Technical Scientific Equipment',
            '1 07 05 990 - Other Machinery Equipment',
            '1 07 05 991 - Acc Depreciation Other Machinery Equipment',
            '4 04 02 020 - Grants Donations in Kind',
            '4 06 01 010 - Miscellaneous Income',
            '5 01 01 010 - Salaries and Wages Regular',
            '5 01 01 020 - Salaries and Wages Casual Contractual',
            '5 01 02 010 - Personnel Economic Relief Allowance',
            '5 01 02 020 - Representation Allowance',
            '5 01 02 030 - Transportation Allowance',
            '5 01 02 040 - Clothing Uniform Allowance',
            '5 01 02 100 - Honoraria',
            '5 01 02 110 - Hazard Pay',
            '5 01 02 120 - Longetivity Pay',
            '5 01 02 130 - Overtime and Night Pay',
            '5 01 02 140 - Year End Bonus',
            '5 01 02 150 - Cash Gift',
            '5 01 03 010 - Retirement and Life Insurance Premiums',
            '5 01 03 020 - Pag ibig Contributions',
            '5 01 03 030 - PhilHealth Contributions',
            '5 01 03 040 - Employees Compensation Insurance Premiums',
            '5 01 04 030 - Terminal Leave Benefits',
            '5 01 04 990 - Other Personnel Benefits',
            '5 02 01 010 - Traveling Expenses Local',
            '5 02 02 010 - Training Expenses',
            '5 02 03 010 - Office Supplies Expenses',
            '5 02 03 020 - Accountable Forms Expenses',
            '5 02 03 070 - Drugs and Medicines Expenses',
            '5 02 03 080 - Medical Dental and Laboratory Supplies Expenses',
            '5 02 03 090 - Fuel Oil and Lubricants Expenses',
            '5 02 03 990 - Other Supplies and Materials Expenses',
            '5 02 04 010 - Water Expenses',
            '5 02 04 020 - Electricity Expenses',
            '5 02 05 010 - Postage and Courier Services',
            '5 02 05 020 - Telephone Expenses',
            '5 02 05 030 - Internet Subscription Expenses',
            '5 02 10 030 - Extraordinary and Miscellaneous Expenses',
            '1 07 06 010 - Motor Vehicles',
            '1 07 06 011 - Accumulated Depreciation Motor Vehicles',
            '1 07 07 010 - Furniture and Fixtures',
            '1 07 07 011 - Accumulated Depreciation Furniture and Fixtures',
            '1 07 10 030 - Buildings and Other Structures',
            '2 01 01 010 - Accounts Payable',
            '2 01 01 020 - Due to Officers and Employees',
            '2 02 01 010 - Due to BIR',
            '2 02 01 020 - Due to GSIS',
            '2 02 01 030 - Due to PAG IBIG',
            '2 02 01 040 - Due to PHILHEALTH',
            '2 04 01 010 - Trust Liabilities',
            '2 04 01 050 - Guaranty Security Deposits Payable',
            '2 04 01 050 - Customers Deposit',
            '2 05 01 990 - Other Deferred Credits',
            '2 99 99 990 - Other Payables',
            '3 01 01 010 - Government Equity',
            '3 01 01 020 - Prior Period Adjustment',
            '4 02 01 980 - Fines and Penalties Service Income',
            '4 02 02 010 - School Fees',
            '4 02 02 020 - Affiliation Fees',
            '4 02 02 050 - Rent Income',
            '4 02 02 220 - Interest Income',
            '4 02 02 990 - Other Business Income',
            '4 03 01 020 - Subsidy from LGUs',
            '5 02 11 990 - Other Professional Services',
            '5 02 13 040 - Repairs and Maint Building Other Structures',
            '5 02 13 050 - Repairs and Maint Machinery and Equipment',
            '5 02 13 060 - Repairs and Maint Transportation Equipment',
            '5 02 16 020 - Fidelity Bond Premiums',
            '5 02 16 030 - Insurance Expenses',
            '5 02 99 020 - Printing and Publication Expenses',
            '5 02 99 030 - Representation Expenses',
            '5 02 99 050 - Rent Expenses',
            '5 02 99 060 - Membership Dues and Contribution to Org',
            '5 02 99 070 - Subscription Expenses',
            '5 02 99 990 - Other Maintenance and Operating Expenses',
            '5 03 01 040 - Bank Charges',
            '5 05 01 040 - Depreciation Building and Structures',
            '5 05 01 050 - Depreciation Machinery and Equipment',
            '5 05 01 060 - Depreciation Transportation Equipment',
            '5 05 01 070 - Depreciation Furnitures and Books'
])],
        ];
    }

    public function setAccountName($value)
    {
        $this->ls_accountname = $value;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveGeneralLedger()
    {       
        $validatedData = $this->validate();

        $validatedData['ls_accountname'] = $this->ls_accountname;

        // Convert empty strings to null
        foreach ($validatedData as $key => $value) {
            if ($value === '') {
                $validatedData[$key] = null;
            }
        }

        ledgerSheetModel::create($validatedData);

        // Update notification state
        $this->notificationMessage = 'Added Successfully';
        $this->showNotification = true;

        $this->resetInput();

        $this->dispatch('notification-shown');

    }

    public function editGeneralLedger($ls_vouchernum)
    {
        $general_ledger = ledgerSheetModel::find($ls_vouchernum);
        if ($general_ledger) {
            
            $this->ls_date = $general_ledger->ls_date;
            $this->ls_vouchernum = $general_ledger->ls_vouchernum;
            $this->ls_particulars = $general_ledger->ls_particulars;
            $this->ls_balance_debit = $general_ledger->ls_balance_debit;
            $this->ls_debit = $general_ledger->ls_debit;
            $this->ls_credit = $general_ledger->ls_credit;
            $this->ls_credit_balance = $general_ledger->ls_credit_balance;
            $this->ls_accountname = $general_ledger->ls_accountname;;
        } 
    }

    public function updateGeneralLedger()
    {
        $validatedData = $this->validate();
        $validatedData['ls_accountname'] = $this->ls_accountname;

        ledgerSheetModel::where('ls_vouchernum', $this->ls_vouchernum)->update([
            'ls_date' => $validatedData['ls_date'],
            'ls_particulars' => $validatedData['ls_particulars'],
            'ls_balance_debit' => $validatedData['ls_balance_debit'],
            'ls_debit' => $validatedData['ls_debit'],
            'ls_credit' => $validatedData['ls_credit'],
            'ls_credit_balance' => $validatedData['ls_credit_balance'],
            'ls_accountname' => $validatedData['ls_accountname'], 
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
        $this->ls_date = '';
        $this->ls_vouchernum = '';
        $this->ls_particulars = '';
        $this->ls_balance_debit = '';
        $this->ls_debit = '';
        $this->ls_credit = '';
        $this->ls_credit_balance = '';
    }

    //ITO NA YUNG DINAGSAG KO 
    // Soft delete GeneralLedger
    public function softDeleteGeneralLedger($ls_vouchernum)
    {
        $general_ledger= ledgerSheetModel::find($ls_vouchernum);
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
        Excel::import(new ledgerSheetImport, $filePath);

        return redirect()->route('LedgerSheet')->with('message', 'File Imported Successfully');
        }
    }

    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function exportGL_XLSX(Request $request) 
    {
        return Excel::download(new ledgerSheetExport($this->ls_accountname), $this->ls_accountname .'.xlsx');
    }
    public function exportGl_CSV(Request $request) 
    {
        return Excel::download(new ledgerSheetExport($this->ls_accountname), $this->ls_accountname .'.csv');
    }



    // public function sortAction($query)
    // {
    //         // Apply the month filter if a month is selected
    //     if ($this->selectedMonth) {
    //         $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
    //         $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
    //         $query->whereBetween('ls_date', [$startOfMonth, $endOfMonth]);
    //     }
    // }

    

    // Method to reset notification
    public function resetNotification()
    {
        $this->showNotification = false;
    }



    // public function calculatetotalsperYear()
    // {
    //     calculate totals per account name by year
    //     save in database
    // }

    // public function calculatetotalsperMonth()
    // {
    //     calculate totals per account name by month
    //     save in database
    // }


    public function searchAction()
    {
        $query = ledgerSheetModel::query();
        $this->ledger_sheet = $query->where(function ($q) {
            $q ->where('ls_accountname', 'like', '%' . $this->search . '%')
            ->orWhere('ls_date', 'like', '%' . $this->search . '%')
            ->orWhere('ls_vouchernum', 'like', '%' . $this->search . '%')
            ->orWhere('ls_particulars', 'like', '%' . $this->search . '%')
            ->orWhere('ls_balance_debit', 'like', '%' . $this->search . '%')
            ->orWhere('ls_debit', 'like', '%' . $this->search . '%')
            ->orWhere('ls_credit', 'like', '%' . $this->search . '%')
            ->orWhere('ls_credit_balance', 'like', '%' . $this->search . '%');
        })->get();
    }
    
    public function fetchGeneralLedgerData()
    {
        // Check if ls_accountname is set
        if ($this->ls_accountname) {
            // Fetch general ledger data filtered by ls_accountname
            $this->ledger_sheet = ledgerSheetModel::where('ls_accountname', $this->ls_accountname)->get(); //and year is 2024
        } else {
            // If ls_accountname is not set, fetch all general ledger data
            $this->ledger_sheet = ledgerSheetModel::all();
        }
    }

    //Sort Newest or Oldest First 
    public function sortAction()
    {
        $this->ledger_sheet = $this->ledger_sheet->sortBy('created_at', SORT_REGULAR, $this->sortDirection === 'asc');
    }
    
    //Sort by Month
    public function sortDate()
    {
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $this->ledger_sheet = $this->ledger_sheet->whereBetween('ls_date', [$startOfMonth, $endOfMonth]);
        }
    }

    public function calculateTotals($query)
    {
        // Calculate totals
        $this->totalBalanceDebit = $query->sum('ls_balance_debit');
        $this->totalDebit = $query->sum('ls_debit');
        $this->totalCredit = $query->sum('ls_credit');
        $this->totalCreditBalance = $query->sum('ls_credit_balance');
    }

        // Render the component
    public function render()
    {
        $query = ledgerSheetModel::query();

    
        if ($this->search) {
            $this->searchAction();
        } else {
            $this->fetchGeneralLedgerData();
        }
    
        // Apply sorting
        $this->sortAction();
        $this->sortDate();

        // Calculate totals
        $this->calculateTotals($query);

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $ledger_sheet = $query->orderBy('ls_vouchernum', 'ASC')->get(); // Changed from paginate() to get()

        return view('livewire.ledger-sheet-show',['ledger_sheet' => $ledger_sheet]);
    }

}
