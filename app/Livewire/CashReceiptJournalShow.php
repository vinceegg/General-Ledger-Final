<?php

namespace App\Livewire;

use App\Exports\CashReceiptJournalExport;
use App\Imports\CashReceiptJournalImport;
use App\Models\CashReceiptJournalModel;
use App\Models\CRJ_SundryModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;
use App\Models\LedgerSheetModel;

class CashReceiptJournalShow extends Component
{
    use WithFileUploads;

    public $crj_entrynum_date,
    $cashreceiptjournal_no,
    $crj_jevnum,
    $crj_payor,
    $crj_collection_debit,
    $crj_collection_credit,
    $crj_deposit_debit,
    $crj_deposit_credit,
    $crj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $selectedMonth;
    public $sortField = 'cashreceiptjournal_no'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalCollectionDebit = 0;
    public $totalCollectionCredit = 0;
    public $totalDepositDebit = 0;
    public $totalDepositCredit = 0;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

    protected function rules()
    {
        return [
            'crj_entrynum_date' => 'required|nullable|date', 
            'crj_jevnum' => 'nullable|string',       
            'crj_payor' => 'nullable|string',
            'crj_collection_debit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_collection_credit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_deposit_debit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_deposit_credit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_sundry_data' => 'required|array|min:1',
            'crj_sundry_data.*.crj_accountcode' => 'nullable|string',
            'crj_sundry_data.*.crj_debit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_sundry_data.*.crj_credit' => 'nullable|numeric|min:0|max:1000000000',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    //@korinlv: added this function
    public function mount()
    {
        // Fetch existing sundry data for the given journal ID
        $journal = CashReceiptJournalModel::find($this->cashreceiptjournal_no);

        if ($journal && $journal->crj_sundry_data()->exists()) {
            // If there is existing sundry data in the database, load it
            $this->crj_sundry_data = $journal->crj_sundry_data->toArray();
        } else {
            // If the database is empty, initialize with an empty structure
            $this->crj_sundry_data = [
                ['crj_accountcode' => '', 'crj_debit' => '', 'crj_credit' => '']
            ];
        }
    }

    //@korinlv: updated this function
    public function saveCashReceiptJournal()
    {
        $validatedData = $this->validate();

        // Convert empty strings to null for the main journal data
        $validatedData = array_map(function($value) {
            return $value === '' ? null : $value;
        }, $validatedData);

        $journal = CashReceiptJournalModel::create($validatedData);

        foreach ($validatedData['crj_sundry_data'] as $code) {
            // Convert empty strings to null for each sundry data entry
            $code = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $code);

            $journal->crj_sundry_data()->create([
                'crj_accountcode' => $code['crj_accountcode'],
                'crj_debit' => $code['crj_debit'],
                'crj_credit' => $code['crj_credit'],
            ]);
        }

        // Update notification state
        $this->notificationMessage = 'Added Successfully';
        $this->showNotification = true;
        $this->dispatch('notification-shown');
        $this->resetInput();     
    }

    //VINCE REMEMBER
    public function saveLedgerSheetCode()
    {
        $this->validate([
            'crj_sundry_data.*.crj_accountcode' => 'nullable|string',
            'crj_sundry_data.*.crj_debit' => 'nullable|numeric|min:0|max:1000000000',
            'crj_sundry_data.*.crj_credit' => 'nullable|numeric|min:0|max:1000000000',
        ]);
    
        foreach ($this->crj_sundry_data as $code) {
            $debit = $code['crj_debit'] ?? null; 
            $credit = $code['crj_credit'] ?? null; 
    
             // Switch-case to nullify credit or debit based on the account code
             switch (trim($code['crj_accountcode'])) {
                // List of account codes which should have $credit set to null
                case '1 01 01 010 - Cash Local Treasury':
                case '1 01 01 020 - Petty Cash':
                case '1 02 01 010 - Cash in Bank - Local Currency Time Deposits':
                case '1 03 01 010 - Accounts Receivable':
                case '1 01 02 010 - Cash in Bank - Local Currency Current Account':
                case '1 03 01 070 - Interests Receivable':
                case '1 01 02 020 - Cash in Bank - Local Currency Savings Account':
                case '1 01 03 020 - Cash in Bank - Foreign Currency Savings Account':
                case '1 03 03 010 - Due from National Government Agencies':
                case '1 03 03 030 - Due from Local Government Units':
                case '1 02 05 010 - Guaranty Deposits':
                case '1 03 05 020 - Advances for Payroll':
                case '1 03 05 030 - Advances to Special Disbursing Officer':
                case '1 03 05 040 - Advances for Officer and Employees':
                case '1 03 06 010 - Receivables - Disallowances / Charges':
                case '1 03 06 020 - Due from Officers and Employees':
                case '1 03 06 990 - Other Receivables':
                case '1 03 01 011 - Allowance for Impairment Loss':
                case '1 04 04 010 - Office Supplies Inventory':
                case '1 04 04 020 - Accountable Forms, Plates and Stickers':
                case '1 04 04 060 - Drugs and Medicines Inventory':
                case '1 04 04 070 - Medical, Dental and Laboratory Supplies Inventory':
                case '1 04 04 990 - Other Supplies and Materials Inventory':
                case '1 05 01 010 - Advances to Contractors':
                case '1 05 01 050 - Prepaid Insurance':
                case '1 05 01 990 - Other Prepayments':
                case '1 07 04 020 - School Buildings':
                case '1 07 05 010 - Machinery':
                case '1 07 05 020 - Office Equipment':
                case '1 07 05 030 - Info and Communication Technology Equipment':
                case '1 07 05 070 - Communication Equipment':
                case '1 07 05 090 - Disaster Response and Rescue Equipment':
                case '1 07 05 100 - Military, Police & Security Equipment':
                case '1 07 05 110 - Medical Equipment':
                case '1 07 05 130 - Sports Equipment':
                case '1 07 05 140 - Technical and Scientific Equipment':
                case '1 07 05 990 - Other Machinery & Equipment':
                case '1 07 06 010 - Motor Vehicles':
                case '1 07 99 090 - Disaster Response & Rescue Equipt':
                case '1 07 99 990 - Other Property, Plant and Equipment':
                case '1 07 10 020 - Infrastructure Assets':
                case '1 07 10 030 - Buildings and Other Structures':
                case '5 01 01 010 - Salaries and Wages - Regular':
                case '5 01 01 020 - Salaries and Wages - Casual/Contractual':
                case '5 01 02 010 - Personnel Economic Relief Allowance (PERA)':
                case '5 01 02 020 - Representation Allowance (RA)':
                case '5 01 02 030 - Transportation Allowance (TA)':
                case '5 01 02 040 - Clothing / Uniform Allowance':
                case '5 01 02 050 - Subsistence Allowance':
                case '5 01 02 060 - Laundry Allowance':
                case '5 01 02 080 - Productivity Incentive Allowance':
                case '5 01 02 100 - Honoraria':
                case '5 01 02 110 - Hazard Pay':
                case '5 01 02 120 - Longevity Pay':
                case '5 01 02 130 - Overtime and Night Pay':
                case '5 01 02 140 - Year End Bonus':
                case '5 01 02 150 - Cash Gift':
                case '5 01 02 990 - Other Bonuses and Allowances':
                case '5 01 03 010 - Retirement and Life Insurance Premiums':
                case '5 01 03 020 - Pag-ibig Contributions':
                case '5 01 03 030 - PhilHealth Contributions':
                case '5 01 03 040 - Employees Compensation Insurance Premiums':
                case '5 01 04 030 - Terminal Leave Benefits':
                case '5 01 04 990 - Other Personnel Benefits':
                case '5 02 01 010 - Travelling Expenses - Local':
                case '5 02 01 020 - Travelling Expenses - Foreign':
                case '5 02 02 010 - Training Expenses':
                case '5 02 03 010 - Office Supplies Expenses':
                case '5 02 03 020 - Accountable Forms Expenses':
                case '5 02 03 070 - Drugs and Medicines Expenses':
                case '5 02 03 080 - Medical, Dental and Laboratory Supplies Expenses':
                case '5 02 03 090 - Fuel, Oil and Lubricants Expenses':
                case '5 02 03 990 - Other Supplies and Materials Expenses':
                case '5 02 04 010 - Water Expenses':
                case '5 02 04 020 - Electricity Expenses':
                case '5 02 05 010 - Postage and Courier Services':
                case '5 02 05 020 - Telephone Expenses':
                case '5 02 05 030 - Internet Subscription Expenses':
                case '5 02 05 040 - Cable, Satellite, Telegraph and Radio Expenses':
                case '5 02 10 030 - Extraordinary and Miscellaneous Expenses':
                case '5 02 11 030 - Consultancy Services':
                case '5 02 11 990 - Other Professional Services':
                case '5 02 12 020 - Janitorial Services':
                case '5 02 12 030 - Security Services':
                case '5 02 13 040 - Repairs and Maint - Building & Other Structures':
                case '5 02 13 050 - Repairs and Maint - Machinery and Equipment':
                case '5 02 13 060 - Repairs and Maint - Transportation Equipment':
                case '5 02 13 070 - Repairs and Maintenance - Furniture and Fixtures':
                case '5 02 16 020 - Fidelity Bond Premiums':
                case '5 02 16 030 - Insurance Expenses':
                case '5 02 99 010 - Advertising Expenses':
                case '5 02 99 020 - Printing and Publication Expenses':
                case '5 02 99 030 - Representation Expenses':
                case '5 02 99 050 - Rent Expenses':
                case '5 02 99 010 - 5 02 99 060 - Membership Dues and Contribution to Org.':
                case '5 02 99 070 - Subscription Expenses':
                case '5 03 01 040 - Bank Charges':
                case '5 02 99 990 - Other Maintenance and Operating Expenses':
                case '5 05 01 040 - Depreciation - Building and Structures':
                case '5 05 01 050 - Depreciation - Machinery and Equipment':
                case '5 05 01 060 - Depreciation - Transportation Equipment':
                case '5 05 01 070 - Depreciation - Furnitures and Books':
                case '5 05 01 090 - Depreciation - Disaster Response & Rescue Equipt.':
                case '5 05 01 990 - Depreciation - Other Property Plant and Equipment':
                case '5 05 03 060 - Impairment Loss-Receivable':
                case '5 05 04 990 - Other Losses':
                    $credit = null;
                    break;
                // List of account codes which should have $debit set to null
                case '1 07 04 021 - Accumulated Depreciation - School Buildings':
                case '1 07 04 991 - Accumulated Depreciation - Other Structures':
                case 'Accumulated Depreciation - Machinery':
                case '1 07 05 021 - Accumulated Depreciation - Office Equipment':
                case '1 07 05 031 - Accumulated Depreciation - ICT Equipment':
                case '1 07 05 071 - Acc Depreciation - Communication Equipment':
                case '1 07 05 091 - Acc Depreciation - Disaster Response and Rescue Equipment':
                case '1 07 05 101 - Acc Depreciation - Military, Police & Security Eqpmt':
                case '1 07 05 111 - Accumulated Depreciation - Medical Equipment':
                case '1 07 05 131 - Accumulated Depreciation - Sports Equipment':
                case '1 07 05 141 - Acc Depreciation - Technical & Scientific Equipment':
                case '1 07 05 991 - Acc Depreciation - Other Machinery & Equipment':
                case '1 07 06 011 - Accumulated Depreciation - Motor Vehicles':
                case '1 07 07 011 - Accumulated Depreciation - Furniture and Fixtures':
                case '1 07 07 021 - Accumulated Depreciation - Books':
                case '2 01 01 010 - Accounts Payable':
                case '2 01 01 020 - Due to Officers and Employees':
                case '2 02 01 010 - Due to BIR':
                case '2 02 01 020 - Due to GSIS':
                case '2 02 01 030 - Due to PAG-IBIG':
                case '2 02 01 040 - Due to PHILHEALTH':
                case '2 04 01 010 - Trust Liabilities':
                case '2 04 01 040 - Guaranty/Security Deposits Payable':
                case '2 04 01 050 - Customers Deposit':
                case '2 05 01 990 - Other Deferred Credits':
                case '2 99 99 990 - Other Payables':
                case '4 02 01 040 - Clearance and Certification Fees':
                case '4 02 01 980 - Fines and Penalties - Service Income':
                case '4 02 01 990 - Other Service Income':
                case '4 02 02 010 - School Fees':
                case '4 02 02 020 - Affiliation Fees':
                case '4 02 02 220 - Interest Income':
                case '4 02 02 990 - Other Business Income':
                case '4 03 01 020 - Subsidy from LGUs':
                case '4 04 02 010 - Grants & Donations in Cash':
                case '4 04 02 020 - Grants & Donations in Kind':
                case '4 06 01 010 - Miscellaneous Income':
                case '4 02 02 050 - Rent Income':
                    $debit = null;
                    break;
            }
    
            LedgerSheetModel::create([
                'ls_vouchernum' => $this->crj_jevnum, 
                'ls_date' => $this->crj_entrynum_date, 
                'ls_particulars' => $this->crj_payor, 
                'ls_accountname' => $code['crj_accountcode'], 
                'ls_debit' => $debit, 
                'ls_credit' => $credit, 
                'ls_credit_balance' => null,
                'ls_balance_debit' => null
            ]);
        }
        // Notification message to show that the operation was successful
        $this->notificationMessage = 'Ledger entries added successfully';
        $this->showNotification = true;
    }

    //@korinlv: added this function
    public function addAccountCode()
    {
        $this->crj_sundry_data[] = ['crj_accountcode' => '', 'crj_debit' => '', 'crj_credit' => ''];
        logger('Sundry added', $this->crj_sundry_data);
    }

    public function removeAccountCode($index)
    {
        unset($this->crj_sundry_data[$index]);
        $this->crj_sundry_data = array_values($this->crj_sundry_data);
        logger('Sundry removed', $this->crj_sundry_data);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    //@korinlv: edited this function
    public function resetInput()
    {
        $this->crj_entrynum_date = '';
        $this->crj_jevnum = '';
        $this->crj_payor = '';
        $this->crj_collection_debit = '';
        $this->crj_collection_credit = '';
        $this->crj_deposit_debit = '';
        $this->crj_deposit_credit = '';
        $this->crj_sundry_data = [];
    }

    // Method to reset notification
    public function resetNotification()
    {
        $this->showNotification = false;
    }

    // Soft delete CashReceiptJournal
    //@korinlv: edited this function
    public function softDeleteCashReceiptJournal($cashreceiptjournal_no)
    {
        $cash_receipt_journal = CashReceiptJournalModel::with('crj_sundry_data')->find($cashreceiptjournal_no);
        if ($cash_receipt_journal) {
            // Delete the related sundries first
            foreach ($cash_receipt_journal->crj_sundry_data as $sundry) {
                $sundry->delete();
            }

        // Now soft delete the journal
        $cash_receipt_journal->delete();
        session()->flash('message', 'Archived Successfully');
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
    
    public function importCRJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new CashReceiptJournalImport, $filePath);

        return redirect()->route('CRJ')->with('message', 'File Imported Successfully');
        }
    }

    // @korin: edited this function
    public function exportCRJ_XLSX(Request $request) 
    {
        return Excel::download(new CashReceiptJournalExport, 'CRJ.xlsx');
    }
    public function exportCRJ_CSV(Request $request) 
    {
        return Excel::download(new CashReceiptJournalExport, 'CRJ.csv');
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

    public function totalsCashReceiptJournal($query){
        //@korinlv:added this function
        $cash_receipt_journals = $query->with(['crj_sundry_data' => function($query){}])->get();
                
        $totalDebit = 0;
        $totalCredit = 0;
        
        foreach ($cash_receipt_journals as $journal) {
            foreach ($journal->crj_sundry_data ?: [] as $sundry) { // Ensure sundry data is treated as an array
                $totalDebit += $sundry->crj_debit ?? 0;
                $totalCredit += $sundry->crj_credit ?? 0;
            }
        }
            
        $this->totalDebit = $totalDebit;
        $this->totalCredit = $totalCredit;
    }

    public function render()
    {
        $query = CashReceiptJournalModel::query();

        $this->totalsCashReceiptJournal($query);

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('crj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        $query->when($this->search, function ($query) {
            $query->where(function ($query) {
                $query->orWhere('crj_jevnum', 'like', '%' . $this->search . '%')
                      ->orWhere('crj_entrynum_date', 'like', '%' . $this->search . '%')
                      ->orWhere('crj_payor', 'like', '%' . $this->search . '%')
                      ->orWhere('crj_collection_debit', 'like', '%' . $this->search . '%')
                      ->orWhere('crj_collection_credit', 'like', '%' . $this->search . '%')
                      ->orWhere('crj_deposit_debit', 'like', '%' . $this->search . '%')
                      ->orWhere('crj_deposit_credit', 'like', '%' . $this->search . '%')
                      ->orWhereHas('crj_sundry_data', function ($subQuery) {
                          $subQuery->where('crj_accountcode', 'like', '%' . $this->search . '%')
                                   ->orWhere('crj_debit', 'like', '%' . $this->search . '%')
                                   ->orWhere('crj_credit', 'like', '%' . $this->search . '%');
                      });
            });
        });

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);
        $this->totalCollectionDebit = $query->sum('crj_collection_debit');
        $this->totalCollectionCredit = $query->sum('crj_collection_credit');
        $this->totalDepositDebit = $query->sum('crj_deposit_debit');
        $this->totalDepositCredit = $query->sum('crj_deposit_credit');

        // Get paginated results
        $cash_receipt_journal = $query->orderBy('cashreceiptjournal_no', 'ASC')->get();

        return view('livewire.cash-receipt-journal-show',['cash_receipt_journal' => $cash_receipt_journal]);
    }
}