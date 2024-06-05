<?php

namespace App\Livewire;

use App\Exports\LedgerSheetExport;
use App\Imports\LedgerSheetImport;
use App\Models\ledgerSheetModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Models\LedgerSheetTotalDebitCreditModel;

class LedgerSheetShow extends Component
{
    use WithFileUploads;

    public 
    $ledgersheet_no,
    $ls_date,
    $ls_vouchernum,
    $ls_particulars,
    $ls_balance_debit,
    $ls_debit,
    $ls_credit,
    $ls_credit_balance,
    $deleteType; // Added deleteType property

    public $ls_accountname= '', $ls_account_title_code = '';
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
    public $saveSelectedYear, $saveSelectedMonth, $selectedSummaryType;
    public $monthlyTotals =[], $yearlyTotals =[];

 
    protected function rules()
    {
        return [         
            'ls_vouchernum'=>'nullable|string', //@vince yung data type inedit ko 
            'ls_date'=>'required|date',
            'ls_particulars'=>'nullable|string', 
            'ls_balance_debit'=> 'nullable|numeric|min:0|max:1000000000',
            'ls_debit'=> 'nullable|numeric|min:0|max:1000000000',
            'ls_credit'=> 'nullable|numeric|min:0|max:1000000000',
            'ls_credit_balance'=> 'nullable|numeric|min:0|max:1000000000',
            'ls_accountname' => ['required', 'string', Rule::in([
                '1 01 01 010 - Cash Local Treasury',
                '1 01 01 020 - Petty Cash',
                '1 01 02 010 - Cash in Bank - Local Currency Current Account',
                '1 01 02 020 - Cash in Bank - Local Currency Savings Account',
                '1 02 01 010 - Cash in Bank - Local Currency Time Deposits',
                '1 01 03 020 - Cash in Bank - Foreign Currency Savings Account',
                '1 02 05 010 - Guaranty Deposits',
                '1 03 01 010 - Accounts Receivable',
                '1 03 01 070 - Interests Receivable',
                '1 03 03 010 - Due from National Government Agencies',
                '1 03 03 030 - Due from Local Government Units',
                '1 03 05 020 - Advances for Payroll',
                '1 03 05 030 - Advances to Special Disbursing Officer',
                '1 03 05 040 - Advances for Officer and Employees',
                '1 03 06 010 - Receivables - Disallowances / Charges',
                '1 03 06 020 - Due from Officers and Employees',
                '1 03 06 990 - Other Receivables',
                '1 03 01 011 - Allowance for Impairment Loss',
                '1 04 04 010 - Office Supplies Inventory',
                '1 04 04 020 - Accountable Forms, Plates and Stickers',
                '1 04 04 060 - Drugs and Medicines Inventory',
                '1 04 04 070 - Medical, Dental and Laboratory Supplies Inventory',
                '1 04 04 990 - Other Supplies and Materials Inventory',
                '1 05 01 010 - Advances to Contractors',
                '1 05 01 050 - Prepaid Insurance',
                '1 05 01 990 - Other Prepayments',
                '1 07 04 020 - School Buildings',
                '1 07 04 021 - Accumulated Depreciation - School Buildings',
                '1 07 04 990 - Other Structures',
                '1 07 04 991 - Accumulated Depreciation - Other Structures',
                '1 07 05 010 - Machinery',
                '1 07 05 011 - Accumulated Depreciation - Machinery',
                '1 07 05 020 - Office Equipment',
                '1 07 05 021 - Accumulated Depreciation - Office Equipment',
                '1 07 05 030 - Info and Communication Technology Equipment',
                '1 07 05 031 - Accumulated Depreciation - ICT Equipment',
                '1 07 05 070 - Communication Equipment',
                '1 07 05 071 - Acc Depreciation - Communication Equipment',
                '1 07 05 090 - Disaster Response and Rescue Equipment',
                '1 07 05 091 - Acc Depreciation - Disaster Response and Rescue Equipment',
                '1 07 05 100 - Military, Police & Security Equipment',
                '1 07 05 101 - Acc Depreciation - Military, Police & Security Eqpmt',
                '1 07 05 110 - Medical Equipment',
                '1 07 05 111 - Accumulated Depreciation - Medical Equipment',
                '1 07 05 130 - Sports Equipment',
                '1 07 05 131 - Accumulated Depreciation - Sports Equipment',
                '1 07 05 140 - Technical and Scientific Equipment',
                '1 07 05 141 - Acc Depreciation - Technical & Scientific Equipment',
                '1 07 05 990 - Other Machinery & Equipment',
                '1 07 05 991 - Acc Depreciation - Other Machinery & Equipment',
                '1 07 06 010 - Motor Vehicles',
                '1 07 06 011 - Accumulated Depreciation - Motor Vehicles',
                '1 07 07 010 - Furniture and Fixtures',
                '1 07 07 011 - Accumulated Depreciation - Furniture and Fixtures',
                '1 07 07 020 - Books',
                '1 07 07 021 - Accumulated Depreciation - Books',
                '1 07 99 090 - Disaster Response & Rescue Equipt',
                '1 07 99 990 - Other Property, Plant and Equipment',
                '1 07 99 991 - Acc Depreciation - Property, Plant and Equipment',
                '1 07 10 020 - Infrastructure Assets',
                '1 07 10 030 - Buildings and Other Structures',
                '2 01 01 010 - Accounts Payable',
                '2 01 01 020 - Due to Officers and Employees',
                '2 02 01 010 - Due to BIR',
                '2 02 01 020 - Due to GSIS',
                '2 02 01 030 - Due to PAG-IBIG',
                '2 02 01 040 - Due to PHILHEALTH',
                '2 04 01 010 - Trust Liabilities',
                '2 04 01 040 - Guaranty/Security Deposits Payable',
                '2 04 01 050 - Customers Deposit',
                '2 05 01 990 - Other Deferred Credits',
                '2 99 99 990 - Other Payables',
                '3 01 01 010 - Government Equity',
                '3 01 01 020 - Prior Period Adjustment',
                '4 02 01 040 - Clearance and Certification Fees',
                '4 02 01 980 - Fines and Penalties - Service Income',
                '4 02 01 990 - Other Service Income',
                '4 02 02 010 - School Fees',
                '4 02 02 020 - Affiliation Fees',
                '4 02 02 050 - Rent Income',
                '4 02 02 220 - Interest Income',
                '4 02 02 990 - Other Business Income',
                '4 03 01 020 - Subsidy from LGUs',
                '4 04 02 010 - Grants & Donations in Cash',
                '4 04 02 020 - Grants & Donations in Kind',
                '4 06 01 010 - Miscellaneous Income',
                '5 01 01 010 - Salaries and Wages - Regular',
                '5 01 01 020 - Salaries and Wages - Casual/Contractual',
                '5 01 02 010 - Personnel Economic Relief Allowance  ( PERA )',
                '5 01 02 020 - Representation Allowance ( RA )',
                '5 01 02 030 - Transportation Allowance ( TA )',
                '5 01 02 040 - Clothing / Uniform Allowance',
                '5 01 02 050 - Subsistence Allowance',
                '5 01 02 060 - Laundry Allowance',
                '5 01 02 080 - Productivity Incentive Allowance',
                '5 01 02 100 - Honoraria',
                '5 01 02 110 - Hazard Pay',
                '5 01 02 120 - Longevity Pay',
                '5 01 02 130 - Overtime and Night Pay',
                '5 01 02 140 - Year End Bonus',
                '5 01 02 150 - Cash Gift',
                '5 01 02 990 - Other Bonuses and Allowances',
                '5 01 03 010 - Retirement and Life Insurance Premiums',
                '5 01 03 020 - Pag-ibig Contributions',
                '5 01 03 030 - PhilHealth Contributions',
                '5 01 03 040 - Employees Compensation Insurance Premiums',
                '5 01 04 030 - Terminal Leave Benefits',
                '5 01 04 990 - Other Personnel Benefits',
                '5 02 01 010 - Travelling Expenses - Local',
                '5 02 01 020 - Travelling Expenses - Foreign',
                '5 02 02 010 - Training Expenses',
                '5 02 03 010 - Office Supplies Expenses',
                '5 02 03 020 - Accountable Forms Expenses',
                '5 02 03 070 - Drugs and Medicines Expenses',
                '5 02 03 080 - Medical, Dental and Laboratory Supplies Expenses',
                '5 02 03 090 - Fuel, Oil and Lubricants Expenses',
                '5 02 03 990 - Other Supplies and Materials Expenses',
                '5 02 04 010 - Water Expenses',
                '5 02 04 020 - Electricity Expenses',
                '5 02 05 010 - Postage and Courier Services',
                '5 02 05 020 - Telephone Expenses',
                '5 02 05 030 - Internet Subscription Expenses',
                '5 02 05 040 - Cable, Satellite, Telegraph and Radio Expenses',
                '5 02 10 030 - Extraordinary and Miscellaneous Expenses',
                '5 02 11 030 - Consultancy Services',
                '5 02 11 990 - Other Professional Services',
                '5 02 12 020 - Janitorial Services',
                '5 02 12 030 - Security Services',
                '5 02 13 040 - Repairs and Maint - Building & Other Structures',
                '5 02 13 050 - Repairs and Maint - Machinery and Equipment',
                '5 02 13 060 - Repairs and Maint - Transportation Equipment',
                '5 02 13 070 - Repairs and Maintenance - Furniture and Fixtures',
                '5 02 16 020 - Fidelity Bond Premiums',
                '5 02 16 030 - Insurance Expenses',
                '5 02 99 010 - Advertising Expenses',
                '5 02 99 020 - Printing and Publication Expenses',
                '5 02 99 030 - Representation Expenses',
                '5 02 99 050 - Rent Expenses',
                '5 02 99 060 - Membership Dues and Contribution to Org.',
                '5 02 99 070 - Subscription Expenses',
                '5 02 99 990 - Other Maintenance and Operating Expenses',
                '5 03 01 040 - Bank Charges',
                '5 05 01 040 - Depreciation - Building and Structures',
                '5 05 01 050 - Depreciation - Machinery and Equipment',
                '5 05 01 060 - Depreciation - Transportation Equipment',
                '5 05 01 070 - Depreciation - Furnitures and Books',
                '5 05 01 090 - Depreciation - Disaster Response & Rescue Equipt.',
                '5 05 01 990 - Depreciation - Other Property Plant and Equipment',
                '5 05 03 060 - Impairment Loss-Receivable',
                '5 05 04 990 - Other Losses',
            ])],
            
        ];
    }

    public function mount($ledger = null)
    {
        if ($ledger) {
            $this->ledgersheet_no = $ledger->ledgersheet_no;
            $this->ls_vouchernum = $ledger->ls_vouchernum;
            $this->ls_date = $ledger->ls_date;
            $this->ls_particulars = $ledger->ls_particulars;
            $this->ls_balance_debit = $ledger->ls_balance_debit;
            $this->ls_debit = $ledger->ls_debit;
            $this->ls_credit = $ledger->ls_credit;
            $this->ls_credit_balance = $ledger->ls_credit_balance;
            $this->ls_accountname = $ledger->ls_accountname;
        }
    }

    public function setAccountName($value)
    {
        $this->ls_accountname = $value;
    }

    public function setAccountNameforTotals($value)
    {
        $this->ls_account_title_code = $value;
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

    public function editGeneralLedger($ledgersheet_no)
    {
        $general_ledger = ledgerSheetModel::find($ledgersheet_no);
        if ($general_ledger) {
                 
            $this->ledgersheet_no = $general_ledger->ledgersheet_no;
            $this->ls_vouchernum = $general_ledger->ls_vouchernum;
            $this->ls_date = $general_ledger->ls_date;
            $this->ls_particulars = $general_ledger->ls_particulars;
            $this->ls_balance_debit = $general_ledger->ls_balance_debit;
            $this->ls_debit = $general_ledger->ls_debit;
            $this->ls_credit = $general_ledger->ls_credit;
            $this->ls_credit_balance = $general_ledger->ls_credit_balance;
            $this->ls_accountname = $general_ledger->ls_accountname;
        } 
    }

    public function updateGeneralLedger()
    {
        $validatedData = $this->validate(); // This will apply the rules defined in the rules() method

        // Proceed with the update if validation passes
        ledgerSheetModel::where('ledgersheet_no', $this->ledgersheet_no)->update($validatedData);

        $validatedData = $this->validate();
        $validatedData['ls_accountname'] = $this->ls_accountname;

        ledgerSheetModel::where('ledgersheet_no', $this->ledgersheet_no)->update([
            'ls_vouchernum' => $validatedData['ls_vouchernum'],
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
    public function softDeleteGeneralLedger($ledgersheet_no)
    {
        $general_ledger= ledgerSheetModel::find($ledgersheet_no);
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

    public function downloadExcelTemplate()
    {
        $filePath = public_path('import_templates/Template.xlsx'); // Adjusted path

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404); // Return a 404 error if the file doesn't exist
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
        
        $cleanAccountName = $this->ls_accountname ? $this->cleanAccountName($this->ls_accountname) : 'LedgerSheet';
        $fileName = $cleanAccountName . '.xlsx';
        return Excel::download(new ledgerSheetExport($this->ls_accountname), $fileName);
    }

    public function exportGl_CSV(Request $request)
    {

        $cleanAccountName = $this->ls_accountname ? $this->cleanAccountName($this->ls_accountname) : 'LedgerSheet';
        $fileName = $cleanAccountName . '.csv';
        return Excel::download(new ledgerSheetExport($this->ls_accountname), $fileName);
    }

    // Method to reset notification
    public function resetNotification()
    {
        $this->showNotification = false;
    }

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

    public function removeSuffix($accountName)
    {
        // Use a regular expression to remove all non-numeric characters
        return preg_replace('/[^0-9 ]/', '', $accountName);
    }
    public function cleanAccountName($accountName)
    {
        // Remove all digits and dashes from the string
        $cleanedName = preg_replace('/[\d-]+/', '', $accountName);
        // Replace multiple spaces with a single space and trim leading/trailing spaces
        return trim(preg_replace('/\s+/', ' ', $cleanedName));
    }

    public function calculateTotalDebitCredit()
    {
        // Validate required fields
        $this->validate([
            'ls_account_title_code' => 'required',
            'selectedSummaryType' => 'required',
            'saveSelectedMonth' => 'required_if:selectedSummaryType,monthly',
        ]);

        // Set the account name
        $this->ls_accountname = $this->ls_account_title_code;

        // Initialize error message
        $this->notificationMessage = '';

        if ($this->selectedSummaryType === 'monthly') {
            // Parse the selected month
            $saveSelectedMonth = Carbon::parse($this->saveSelectedMonth);

            // Calculate totals for the selected month and year
            $totals = ledgerSheetModel::whereYear('ls_date', $saveSelectedMonth->year)
                ->whereMonth('ls_date', $saveSelectedMonth->month)
                ->selectRaw('ls_accountname, sum(ls_balance_debit) as total_balance_debit, sum(ls_debit) as total_debit, sum(ls_credit) as total_credit, sum(ls_credit_balance) as total_credit_balance')
                ->groupBy('ls_accountname')
                ->get();

            // Check if totals are found
            if ($totals->isEmpty()) {
                $this->notificationMessage = 'No data found for the selected month and year.';
                $this->showNotification = true;
                return;
            }

            // Process the totals...
            foreach ($totals as $total) {
                LedgerSheetTotalDebitCreditModel::updateOrCreate(
                    [
                        'ls_account_title_code' => $total->ls_accountname,
                        'ls_summary_type' => 'monthly',
                        'ls_summary_month' => $saveSelectedMonth->month,
                    ],
                    [
                        'ls_total_credit' => $total->total_credit ?? 0,
                        'ls_total_debit' => $total->total_debit ?? 0,
                    ]
                );
            }
        }

        // Notify user of success if no errors
        if (empty($this->notificationMessage)) {
            $this->notificationMessage = 'Summary saved successfully!';
        }
        $this->showNotification = true;
        $this->dispatch('notification-shown');
        $this->resetInput();
    }

    public function calculateTotals($query)
    {
        if ($this->ls_accountname) {
            // Calculate totals for the selected ls_accountname
            $filteredQuery = $query->where('ls_accountname', $this->ls_accountname);

            // Calculate totals for the selected ls_accountname
            $this->totalBalanceDebit = $filteredQuery->sum('ls_balance_debit');
            $this->totalDebit = $filteredQuery->sum('ls_debit');
            $this->totalCredit = $filteredQuery->sum('ls_credit');
            $this->totalCreditBalance = $filteredQuery->sum('ls_credit_balance');
        } else {
            // Calculate totals for all account names
            $this->totalBalanceDebit = $query->sum('ls_balance_debit');
            $this->totalDebit = $query->sum('ls_debit');
            $this->totalCredit = $query->sum('ls_credit');
            $this->totalCreditBalance = $query->sum('ls_credit_balance');
        }
    }
    // Pangcheck lang to kung nassave ng tama sa DB (remove this function later)
    public function showTotals()
    {
        // Fetch totals for all months and years
        $this->monthlyTotals = LedgerSheetTotalDebitCreditModel::where('ls_summary_type', 'monthly')->get();
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