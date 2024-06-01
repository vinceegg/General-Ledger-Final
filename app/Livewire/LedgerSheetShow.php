<?php

namespace App\Livewire;

use App\Exports\ledgerSheetExport;
use App\Imports\ledgerSheetImport;
use App\Models\ledgerSheetModel;
use App\Models\ledgerSheetTotalDebitCreditModel;
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
            'ls_accountname' => ['required', 'string', Rule::in(['Cash Local Treasury', 'Accounts Receivable', 'Rent Income'])],
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
        $this->ledger_sheet = ledgerSheetModel::where(function ($q) {
            $q ->Where('ls_date', 'like', '%' . $this->search . '%')
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

    public function calculateTotals()
    {
        // Start with the base query
        $query = LedgerSheetModel::query();

        // Apply filtering based on account name
        if ($this->ls_accountname) {
            $query->where('ls_accountname', $this->ls_accountname);
        }

        // Apply date filtering if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            $query->whereBetween('ls_date', [$startOfMonth, $endOfMonth]);
        }

        // Apply sorting
        $query->orderBy('ls_date', $this->sortDirection);

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('ls_date', 'like', '%' . $this->search . '%')
                    ->orWhere('ls_vouchernum', 'like', '%' . $this->search . '%')
                    ->orWhere('ls_particulars', 'like', '%' . $this->search . '%')
                    ->orWhere('ls_balance_debit', 'like', '%' . $this->search . '%')
                    ->orWhere('ls_debit', 'like', '%' . $this->search . '%')
                    ->orWhere('ls_credit', 'like', '%' . $this->search . '%')
                    ->orWhere('ls_credit_balance', 'like', '%' . $this->search . '%');
            });
        }

        // Calculate the totals
        $this->totalBalanceDebit = $query->sum('ls_balance_debit');
        $this->totalDebit = $query->sum('ls_debit');
        $this->totalCredit = $query->sum('ls_credit');
        $this->totalCreditBalance = $query->sum('ls_credit_balance');

        // Update the totals directly from $this->ledger_sheet
        $this->ledger_sheet->transform(function ($item) use ($query) {
            return $item->setAttribute('total_balance_debit', $query->sum('ls_balance_debit'))
                        ->setAttribute('total_debit', $query->sum('ls_debit'))
                        ->setAttribute('total_credit', $query->sum('ls_credit'))
                        ->setAttribute('total_credit_balance', $query->sum('ls_credit_balance'));
        });
    }

    public function calculateTotalsPerYear()
    {
        $year = Carbon::now()->year; // Replace with selected year if needed
        $totals = LedgerSheetModel::whereYear('ls_date', $year)
            ->selectRaw('ls_accountname, sum(ls_balance_debit) as total_balance_debit, sum(ls_debit) as total_debit, sum(ls_credit) as total_credit, sum(ls_credit_balance) as total_credit_balance')
            ->groupBy('ls_accountname')
            ->get();

        foreach ($totals as $total) {
            ledgerSheetTotalDebitCreditModel::updateOrCreate(
                [
                    'ls_accountname' => $total->ls_accountname,
                    'ls_summary_type' => 'yearly',
                    'ls_summary_year' => $year,
                ],
                [
                    'ls_total_credit' => $total->total_credit,
                    'ls_total_debit' => $total->total_debit,
                ]
            );
        }
    }

    public function calculateTotalsPerMonth()
    {
        $selectedMonth = Carbon::parse($this->selectedMonth);
        $totals = LedgerSheetModel::whereYear('ls_date', $selectedMonth->year)
            ->whereMonth('ls_date', $selectedMonth->month)
            ->selectRaw('ls_accountname, sum(ls_balance_debit) as total_balance_debit, sum(ls_debit) as total_debit, sum(ls_credit) as total_credit, sum(ls_credit_balance) as total_credit_balance')
            ->groupBy('ls_accountname')
            ->get();

        foreach ($totals as $total) {
            ledgerSheetTotalDebitCreditModel::updateOrCreate(
                [
                    'ls_accountname' => $total->ls_accountname,
                    'ls_summary_type' => 'monthly',
                    'ls_summary_year' => $selectedMonth->year,
                    'ls_summary_month' => $selectedMonth->month,
                ],
                [
                    'ls_total_credit' => $total->total_credit,
                    'ls_total_debit' => $total->total_debit,
                ]
            );
        }
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
        $this->calculateTotals();

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $ledger_sheet = $query->orderBy('ls_vouchernum', 'ASC')->get(); // Changed from paginate() to get()

        return view('livewire.ledger-sheet-show',['ledger_sheet' => $ledger_sheet]);
    }

}
