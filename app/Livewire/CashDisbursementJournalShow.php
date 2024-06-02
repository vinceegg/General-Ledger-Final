<?php

namespace App\Livewire;

use App\Models\CashDisbursementJournalModel;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\CashDisbursementJournalExport;
use App\Imports\CashDisbursementJournalImport;
use App\Models\CDJ_SundryModel;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LedgerSheetModel;

class CashDisbursementJournalShow extends Component
{
    use WithFileUploads;

    public $cdj_entrynum_date,
    $cashdisbursementjournal_no,
    $cdj_referencenum,
    $cdj_bur,
    $cdj_accountable_officer,
    $cdj_jevnum,
    $cdj_credit_accountcode,
    $cdj_amount,
    $cdj_account1,
    $cdj_account2,
    $cdj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $selectedMonth;
    public $sortField = 'cashdisbursementjournal_no'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalAmount = 0;
    public $totalAccount1 = 0;
    public $totalAccount2 = 0;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

    //@korin:edited this
    protected function rules()
    {
        return [
            'cdj_jevnum'=>'nullable|string',
            'cdj_entrynum_date'=>'required|nullable|date',
            'cdj_referencenum'=>'nullable|string',
            'cdj_bur'=>'nullable|integer',
            'cdj_accountable_officer'=>'nullable|string',
            'cdj_credit_accountcode'=>'nullable|string',
            'cdj_amount'=> 'nullable|numeric',
            'cdj_account1'=> 'nullable|numeric',
            'cdj_account2'=> 'nullable|numeric',
            'cdj_sundry_data'=>'required|array|min:1',
            'cdj_sundry_data.*.cdj_sundry_accountcode'=>'nullable|string',
            'cdj_sundry_data.*.cdj_pr'=>'nullable|string',
            'cdj_sundry_data.*.cdj_debit'=> 'nullable|numeric|min:0|max:1000000000',
            'cdj_sundry_data.*.cdj_credit'=> 'nullable|numeric|min:0|max:1000000000',
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
        $cash_disbursement_journal = CashDisbursementJournalModel::find($this->cashdisbursementjournal_no);

        if ($cash_disbursement_journal && $cash_disbursement_journal->cdj_sundry_data()->exists()) {
            // If there is existing sundry data in the database, load it
            $this->cdj_sundry_data = $cash_disbursement_journal->cdj_sundry_data->toArray();
        } else {
            // If the database is empty, initialize with an empty structure
            $this->cdj_sundry_data = [
                ['cdj_sundry_accountcode' => '', 'cdj_pr' => '', 'cdj_debit' => '', 'cdj_credit' => '']
            ];
        }
    }

    //@korinlv: updated this function
    public function saveCashDisbursementJournal()
    {
        $validatedData = $this->validate();
        
        // Convert empty strings to null for the main journal data
        $validatedData = array_map(function($value) {
            return $value === '' ? null : $value;
        }, $validatedData);

        $cash_disbursement_journal = CashDisbursementJournalModel::create($validatedData);

        foreach ($validatedData['cdj_sundry_data'] as $code) {
            // Convert empty strings to null for each sundry data entry
            $code = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $code);

            $cash_disbursement_journal->cdj_sundry_data()->create([
                'cdj_sundry_accountcode' => $code['cdj_sundry_accountcode'],
                'cdj_pr' => $code['cdj_pr'],
                'cdj_debit' => $code['cdj_debit'],
                'cdj_credit' => $code['cdj_credit'],
            ]);
        }

        // Update notification state
        $this->notificationMessage = 'Added Successfully';
        $this->showNotification = true;

        $this->resetInput();

        $this->dispatch('notification-shown');
    }
    
    //VINCE REMEMBER
    public function saveLedgerSheetCode()
    {
        $this->validate([
            'cdj_sundry_data.*.cdj_sundry_accountcode'=>'nullable|string',
            'cdj_sundry_data.*.cdj_pr'=>'nullable|string',
            'cdj_sundry_data.*.cdj_debit'=> 'nullable|numeric|min:0|max:1000000000',
            'cdj_sundry_data.*.cdj_credit'=> 'nullable|numeric|min:0|max:1000000000',
        ]);
    
        foreach ($this->cdj_sundry_data as $code) {
            $debit = $code['cdj_debit'] ?? null; // Default to the provided debit value
            $credit = $code['cdj_credit'] ?? null; // Default to the provided credit value
    
            switch ($code['cdj_sundry_accountcode']) {
                case '1 01 01 010 - Cash Local Treasury':
                    $credit = null; 
                    break;
                case '1 01 01 020 - Petty Cash':
                    $credit = null; 
                    break;
                case '1 02 01 010 - Cash in Bank - Local Currency Time Deposits':
                    $credit = null; 
                    break;
                case '1 03 01 010 - Accounts Receivable':
                    $credit = null; 
                    break; 
                case '1 01 02 010 - Cash in Bank - Local Currency Current Account':
                    $credit = null; 
                    break;           
                case '1 03 01 070 - Interests Receivable':
                    $credit = null; 
                    break;
                case '1 01 02 020 - Cash in Bank - Local Currency Savings Account':
                    $credit = null; 
                    break;
                case '1 01 03 020 - Cash in Bank - Foreign Currency Savings Account':
                    $credit = null; 
                    break;
                case '1 03 03 010 - Due from National Government Agencies':
                    $credit = null; 
                    break; 
                case '1 03 03 030 - Due from Local Government Units ':
                    $credit = null; 
                    break;           
                case '1 02 05 010 - Guaranty Deposits':
                    $credit = null; 
                    break;
                case '1 03 05 020 - Advances for Payroll':
                    $credit = null; 
                    break; 
                case '1 03 05 030 - Advances to Special Disbursing Officer':
                    $credit = null; 
                    break;           
                case '1 03 05 040 - Advances for Officer and Employees':
                    $credit = null; 
                    break;
                case '1 03 06 010 - Receivables - Disallowances / Charges':
                    $credit = null; 
                    break;           
                case '1 03 06 020 - Due from Officers and Employees':
                    $credit = null; 
                    break;
                case '1 03 06 990 - Other Receivables':
                    $credit = null; 
                    break; 
                case '1 03 01 011 - Allowance for Impairment Loss':
                    $credit = null; 
                    break;           
                case '1 04 04 010 - Office Supplies Inventory':
                    $credit = null; 
                    break;
                case '1 04 04 020 - Accountable Forms, Plates and Stickers':
                    $credit = null; 
                    break; 
                case '1 04 04 060 - Drugs and Medicines Inventory':
                    $credit = null; 
                    break;           
                case '1 04 04 070 - Medical, Dental and Laboratory Supplies Inventory':
                    $credit = null; 
                    break;
                case '1 04 04 990 - Other Supplies and Materials Inventory':
                    $credit = null; 
                    break; 
                case '1 05 01 010 - Advances to Contractors':
                    $credit = null; 
                    break;           
                case '1 05 01 050 - Prepaid Insurance':
                    $credit = null; 
                    break;
                case '1 05 01 990 - Other Prepayments':
                    $credit = null; 
                    break;           
                case '1 07 04 020 - School Buildings':
                    $credit = null; 
                    break;
                case '1 07 04 021 - Accumulated Depreciation - School Buildings':
                    $debit = null; 
                    break;
                case '1 07 04 991 - Accumulated Depreciation - Other Structures':
                    $debit = null; 
                    break;
                case 'Accumulated Depreciation - Machinery':
                    $debit = null; 
                    break;
                case '1 07 04 990 - Other Structures':
                    $credit = null; 
                    break; 
                case '1 07 05 010 - Machinery':
                    $credit = null; 
                    break;
                case '1 07 05 020 - Office Equipment':
                    $credit = null; 
                    break;  
                case '1 07 05 021 - Accumulated Depreciation - Office Equipment':
                    $debit = null; 
                    break;
                case '1 07 05 030 - Info and Communication Technology Equipment':
                    $credit = null; 
                    break; 
                case '1 07 05 031 - Accumulated Depreciation - ICT Equipment':
                    $debit = null; 
                    break;
                case '1 07 05 070 - Communication Equipment':
                    $credit = null; 
                    break; 
                case '1 07 05 071 - Acc Depreciation - Communication Equipment':
                    $debit = null; 
                    break;   
                case '1 07 05 090 - Disaster Response and Rescue Equipment':
                    $credit = null; 
                    break; 
                case '1 07 05 091 - Acc Depreciation - Disaster Response and Rescue Equipment':
                    $debit = null; 
                    break;
                case '1 07 05 100 - Military, Police & Security Equipment':
                    $credit = null; 
                    break; 
                case '1 07 05 101 - Acc Depreciation - Military, Police & Security Eqpmt':
                    $debit = null; 
                    break;
                case '1 07 05 110 - Medical Equipment':
                    $credit = null; 
                    break; 
                case '1 07 05 111 - Accumulated Depreciation - Medical Equipment':
                    $debit = null; 
                    break;
                case '1 07 05 130 - Sports Equipment':
                    $credit = null; 
                    break; 
                case '1 07 05 131 - Accumulated Depreciation - Sports Equipment':
                    $debit = null; 
                    break;
                case '1 07 05 140 - Technical and Scientific Equipment':
                    $credit = null; 
                    break; 
                case '1 07 05 141 - Acc Depreciation - Technical & Scientific Equipment':
                    $debit = null; 
                    break;
                case '1 07 05 990 - Other Machinery & Equipment':
                    $credit = null; 
                    break;
                case '1 07 05 991 - Acc Depreciation - Other Machinery & Equipment':
                    $debit = null; 
                    break;
                case '1 07 06 010 - Motor Vehicles':
                    $credit = null; 
                    break;
                case '1 07 06 011 - Accumulated Depreciation - Motor Vehicles':
                    $debit = null; 
                    break;
                case '1 07 07 011 - Accumulated Depreciation - Furniture and Fixtures':
                    $debit = null; 
                    break;
                case '1 07 07 021 - Accumulated Depreciation - Books':
                    $debit = null; 
                    break;
                case '1 07 07 010 - Furniture and Fixtures':
                    $credit = null; 
                    break; 
                case '1 07 07 020 - Books':
                    $credit = null; 
                    break; 
                case '1 07 99 090 - Disaster Response & Rescue Equipt':
                    $credit = null; 
                    break; 
                case '1 07 99 990 - Other Property, Plant and Equipment':
                    $credit = null; 
                    break; 
                case '1 07 99 991 - Acc Depreciation - Property, Plant and Equipment':
                    $credit = null; 
                    break;
                case '1 07 10 020 - Infrastructure Assets':
                    $credit = null; 
                    break; 
                case '1 07 10 030 - Buildings and Other Structures':
                    $credit = null; 
                    break;  
                case '2 01 01 010 - Accounts Payable':
                    $debit = null; 
                    break;
                case '2 01 01 020 - Due to Officers and Employees':
                    $debit = null; 
                    break;
                case '2 02 01 010 - Due to BIR ':
                    $debit = null; 
                    break;
                case '2 02 01 020 - Due to GSIS':
                    $debit = null; 
                    break;
                case '2 02 01 030 - Due to PAG-IBIG':
                    $debit = null; 
                    break;
                case '2 02 01 040 - Due to PHILHEALTH':
                    $debit = null; 
                    break;
                case '2 04 01 010 - Trust Liabilities':
                    $debit = null; 
                    break;
                case '2 04 01 040 - Guaranty/Security Deposits Payable':
                    $debit = null; 
                    break;
                case '2 04 01 050 - Customers Deposit':
                    $debit = null; 
                    break;
                case '2 05 01 990 - Other Deferred Credits':
                    $debit = null; 
                    break;
                case '2 99 99 990 - Other Payables':
                    $debit = null; 
                    break;
                case '4 02 01 040 - Clearance and Certification Fees':
                    $debit = null; 
                    break;
                case '4 02 01 980 - Fines and Penalties - Service Income':
                    $debit = null; 
                    break;
                case '4 02 01 990 - Other Service Income':
                    $debit = null; 
                    break;
                case '4 02 02 010 - School Fees':
                    $debit = null; 
                    break;
                case '4 02 02 020 - Affiliation Fees':
                    $debit = null; 
                    break;
                case '4 02 02 220 - Interest Income':
                    $debit = null; 
                    break;
                case '4 02 02 990 - Other Business Income':
                    $debit = null; 
                    break;
                case '4 03 01 020 - Subsidy from LGUs':
                    $debit = null; 
                    break;
                case '4 04 02 010 - Grants & Donations in Cash':
                    $debit = null; 
                    break;
                case '4 04 02 020 - Grants & Donations in Kind':
                    $debit = null; 
                    break;
                case '4 06 01 010 - Miscellaneous Income':
                    $debit = null; 
                    break;
                case '4 03 01 020 - Subsidy from LGUs':
                    $debit = null; 
                    break;
                case '4 02 02 050 - Rent Income':
                    $debit = null; 
                    break;
                case '5 01 01 010 - Salaries and Wages - Regular':
                    $credit = null; 
                    break; 
                case '5 01 01 020 - Salaries and Wages - Casual/Contractual':
                    $credit = null; 
                    break; 
                case '5 01 02 010 - Personnel Economic Relief Allowance ( PERA )':
                    $credit = null; 
                    break; 
                case '5 01 02 020 - Representation Allowance ( RA )':
                    $credit = null; 
                    break; 
                case '5 01 02 030 - Transportation Allowance ( TA )':
                    $credit = null; 
                    break; 
                case '5 01 02 040 - Clothing / Uniform Allowance':
                    $credit = null; 
                    break; 
                case '5 01 02 050 - Subsistence Allowance':
                    $credit = null; 
                    break; 
                case '5 01 02 060 - Laundry Allowance':
                    $credit = null; 
                    break; 
                case '5 01 02 080 - Productivity Incentive Allowance':
                    $credit = null; 
                    break; 
                case '5 01 02 100 - Honoraria':
                    $credit = null; 
                    break; 
                case '5 01 02 110 - Hazard Pay':
                    $credit = null; 
                    break; 
                case '5 01 02 120 - Longevity Pay':
                    $credit = null; 
                    break; 
                case '5 01 02 130 - Overtime and Night Pay':
                    $credit = null; 
                    break; 
                case '5 01 02 140 - Year End Bonus':
                    $credit = null; 
                    break; 
                case '5 01 02 150 - Cash Gift':
                    $credit = null; 
                    break; 
                case '5 01 02 990 - Other Bonuses and Allowances':
                    $credit = null; 
                    break; 
                case '5 01 03 010 - Retirement and Life Insurance Premiums':
                    $credit = null; 
                    break; 
                case '5 01 03 020 - Pag-ibig Contributions':
                    $credit = null; 
                    break; 
                case '5 01 03 030 - PhilHealth Contributions':
                    $credit = null; 
                    break; 
                case '5 01 03 040 - Employees Compensation Insurance Premiums':
                    $credit = null; 
                    break; 
                case '5 01 04 030 - Terminal Leave Benefits':
                    $credit = null; 
                    break; 
                case '5 01 04 990 - Other Personnel Benefits':
                    $credit = null; 
                    break; 
                case '5 02 01 010 - Travelling Expenses - Local':
                    $credit = null; 
                    break; 
                case '5 02 01 020 - Travelling Expenses - Foreign':
                    $credit = null; 
                    break; 
                case '5 02 02 010 - Training Expenses':
                    $credit = null; 
                    break; 
                case '5 02 03 010 - Office Supplies Expenses':
                    $credit = null; 
                    break; 
                case '5 02 03 020 - Accountable Forms Expenses':
                    $credit = null; 
                    break; 
                case '5 02 03 070 - Drugs and Medicines Expenses':
                    $credit = null; 
                    break; 
                case '5 02 03 080 - Medical, Dental and Laboratory Supplies Expenses':
                    $credit = null; 
                    break; 
                case '5 02 03 090 - Fuel, Oil and Lubricants Expenses':
                    $credit = null; 
                    break; 
                case '5 02 03 990 - Other Supplies and Materials Expenses':
                    $credit = null; 
                    break; 
                case '5 02 04 010 - Water Expenses':
                    $credit = null; 
                    break;      
                case '5 02 04 020 - Electricity Expenses':
                    $credit = null; 
                    break; 
                case '5 02 05 010 - Postage and Courier Services':
                    $credit = null; 
                    break; 
                case '5 02 05 020 - Telephone Expenses':
                    $credit = null; 
                    break; 
                case '5 02 05 030 - Internet Subscription Expenses':
                    $credit = null; 
                    break; 
                case '5 02 05 040 - Cable,Satellite,Telegraph and Radio Expenses':
                    $credit = null; 
                    break; 
                case '5 02 10 030 - Extraordinary and Miscellaneous Expenses':
                    $credit = null; 
                    break; 
                case '5 02 11 030 - Consultancy Services':
                    $credit = null; 
                    break; 
                case '5 02 11 990 - Other Professional Services':
                    $credit = null; 
                    break; 
                case '5 02 12 020 - Janitorial Services':
                    $credit = null; 
                    break; 
                case '5 02 12 030 - Security Services':
                    $credit = null; 
                    break; 
                case '5 02 13 040 - Repairs and Maint - Building & Other Structures':
                    $credit = null; 
                    break; 
                case '5 02 13 050 - Repairs and Maint - Machinery and Equipment':
                    $credit = null; 
                    break; 
                case '5 02 13 060 - Repairs and Maint - Transportation Equipment':
                    $credit = null; 
                    break; 
                case '5 02 13 070 - Repairs and Maintenance - Furniture and Fixtures':
                    $credit = null; 
                    break; 
                case '5 02 16 020 - Fidelity Bond Premiums':
                    $credit = null; 
                    break; 
                case '5 02 16 030 - Insurance Expenses':
                    $credit = null; 
                    break;
                case '5 02 99 010 - Advertising Expenses':
                    $credit = null; 
                    break; 
                case '5 02 99 020 - Printing and Publication Expenses':
                    $credit = null; 
                    break; 
                case '5 02 99 030 - Representation Expenses':
                    $credit = null; 
                    break; 
                case '5 02 99 050 - Rent Expenses':
                    $credit = null; 
                    break;
                case '5 02 99 010 - 5 02 99 060 - Membership Dues and Contribution to Org.':
                    $credit = null; 
                    break; 
                case '5 02 99 070 - Subscription Expenses':
                    $credit = null; 
                    break; 
                case '5 03 01 040 - Bank Charges':
                    $credit = null; 
                    break; 
                case '5 02 99 990 - Other Maintenance and Operating Expenses ':
                    $credit = null; 
                    break;
                case '5 05 01 040 - Depreciation - Building and Structures':
                    $credit = null; 
                    break; 
                case '5 05 01 050 - Depreciation - Machinery and Equipment':
                    $credit = null; 
                    break; 
                case '5 05 01 060 - Depreciation - Transportation Equipment':
                    $credit = null; 
                    break; 
                case '5 05 01 070 - Depreciation - Furnitures and Books':
                    $credit = null; 
                    break;
                case '5 05 01 090 - Depreciation - Disaster Response & Rescue Equipt.':
                    $credit = null; 
                    break; 
                case '5 05 01 990 - Depreciation - Other Property Plant and Equipment':
                    $credit = null; 
                    break; 
                case '5 05 03 060 - Impairment Loss-Receivable':
                    $credit = null; 
                    break; 
                case '5 05 04 990 - Other Losses':
                    $credit = null; 
                    break;                
            }
    
            LedgerSheetModel::create([
                'ls_vouchernum' => $this->cdj_jevnum, 
                'ls_date' => $this->cdj_entrynum_date, 
                'ls_particulars' => $this->cdj_accountable_officer, 
                'ls_accountname' => $code['cdj_sundry_accountcode'], 
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
        $this->cdj_sundry_data[] = ['cdj_sundry_accountcode' => '', 'cdj_pr' => '', 'cdj_debit' => '', 'cdj_credit' => ''];
        logger('Sundry added', $this->cdj_sundry_data);
    }

    public function removeAccountCode($index)
    {
        unset($this->cdj_sundry_data[$index]);
        $this->cdj_sundry_data = array_values($this->cdj_sundry_data);
        logger('Sundry removed', $this->cdj_sundry_data);
    }

    //@korinlv: updated this function
    public function editCashDisbursementJournal($cashdisbursementjournal_no)
    {
        $cash_disbursement_journal = CashDisbursementJournalModel::find($cashdisbursementjournal_no);
        if ($cash_disbursement_journal) {
            $this->cashdisbursementjournal_no =  $cash_disbursement_journal->$cashdisbursementjournal_no;
            $this->cdj_jevnum = $cash_disbursement_journal->cdj_jevnum;
            $this->cdj_entrynum_date = $cash_disbursement_journal->cdj_entrynum_date;
            $this->cdj_referencenum = $cash_disbursement_journal->cdj_referencenum;
            $this->cdj_bur = $cash_disbursement_journal->cdj_bur;
            $this->cdj_accountable_officer = $cash_disbursement_journal->cdj_accountable_officer;           
            $this->cdj_credit_accountcode = $cash_disbursement_journal->cdj_credit_accountcode;
            $this->cdj_amount = $cash_disbursement_journal->cdj_amount;
            $this->cdj_account1 = $cash_disbursement_journal->cdj_account1;
            $this->cdj_account2 = $cash_disbursement_journal->cdj_account2;

            $this->cdj_sundry_data = $cash_disbursement_journal->cdj_sundry_data->toArray();
        }
    }

    //NEW VERSION NG 'UPDATE' MAS MAHABA, WHY THO?
    //@korinlv: edited this function
    //@marii eto yung function na inupdate ko 
    public function updateCashDisbursementJournal()
    {
        $validatedData = $this->validate([
            'cdj_jevnum'=>'nullable|string',
            'cdj_entrynum_date'=>'nullable|date',
            'cdj_referencenum'=>'nullable|string',
            'cdj_bur'=>'nullable|integer',
            'cdj_accountable_officer'=>'nullable|string',           
            'cdj_credit_accountcode'=>'nullable|string',
            'cdj_amount'=> 'nullable|numeric',
            'cdj_account1'=> 'nullable|numeric',
            'cdj_account2'=> 'nullable|numeric',
            'cdj_sundry_data' => 'required|array|min:1',
            'cdj_sundry_data.*.cdj_sundry_accountcode'=>'nullable|string',
            'cdj_sundry_data.*cdj_pr'=>'nullable|string',
            'cdj_sundry_data.*cdj_debit'=> 'nullable|numeric|min:0|max:100000000',
            'cdj_sundry_data.*cdj_credit'=> 'nullable|numeric|min:0|max:100000000',
        ]);

            // Convert empty strings to null in the main journal data
            $validatedData = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $validatedData);

            $cash_disbursement_journal = CashDisbursementJournalModel::findOrFail($this->cashdisbursementjournal_no);
            $cash_disbursement_journal->update($validatedData);

            // Get existing sundry data IDs
            $existingSundryIds = $cash_disbursement_journal->cdj_sundry_data->pluck('cdj_id')->toArray();

            // Prepare an array to hold the IDs of incoming sundry data
            $incomingSundryIds = [];

            foreach ($this->cdj_sundry_data as $data) {
                // Convert empty strings to null for each sundry data entry
                $data = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $data);

                if (isset($data['cdj_id']) && $data['cdj_id']) {
                    // Update existing account code
                    $accountCode = CDJ_SundryModel::find($data['cdj_id']);
                    if ($accountCode) {
                        $accountCode->update($data);
                        $incomingSundryIds[] = $data['cdj_id'];
                    }
                } else {
                    // Create new account code
                    $newAccountCode = $cash_disbursement_journal->cdj_sundry_data()->create($data);
                    $incomingSundryIds[] = $newAccountCode->id;

                    // Reset other fields except the newly added sundry entry
                    $this->cdj_sundry_data[] = ['cdj_sundry_accountcode' => '', 'cdj_pr' => '', 'cdj_debit' => '', 'cdj_credit' => ''];
                }
            }

            // Calculate sundry data IDs to delete (those that are not in the incoming data)
            $sundryIdsToDelete = array_diff($existingSundryIds, $incomingSundryIds);

            // Delete sundry data not in the incoming data
            CDJ_SundryModel::destroy($sundryIdsToDelete);

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

    //@korinlv: edited this function
    public function resetInput()
    {
            $this->cdj_jevnum = '';
            $this->cdj_entrynum_date = '';
            $this->cdj_referencenum = '';
            $this->cdj_bur = '';
            $this->cdj_accountable_officer = '';        
            $this->cdj_credit_accountcode ='';
            $this->cdj_amount = '';
            $this->cdj_account1 = '';
            $this->cdj_account2 = '';
            $this->cdj_sundry_data = [];

    }

    //@korinlv: edited this function
    public function softDeleteCashDisbursementJournal($cashdisbursementjournal_no)
    {
        $cash_disbursement_journal= CashDisbursementJournalModel::find($cashdisbursementjournal_no);
        if ( $cash_disbursement_journal) {
            foreach ($cash_disbursement_journal->cdj_sundry_data as $accountCode){
                $accountCode->delete();
            }
            
            $cash_disbursement_journal->delete();
            session()->flash('message', 'Soft Deleted Successfully');
    }
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function importCDJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new CashDisbursementJournalImport, $filePath);

        return redirect()->back();
        }
    }

    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    // @korin: edited this function
    public function exportCDJ_XLSX(Request $request) 
    {
        return Excel::download(new CashDisbursementJournalExport, 'CDJ.xlsx');
    }
    public function exportCDJ_CSV(Request $request) 
    {
        return Excel::download(new CashDisbursementJournalExport, 'CDJ.csv');
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

    public function totalsCashDisbursementJournal($query){
        //@korinlv:added this function
        $cash_disbursement_journals = $query->with(['cdj_sundry_data' => function($query){}])->get();
        
        $totalDebit = 0;
        $totalCredit = 0;

        foreach ($cash_disbursement_journals as $journal) {
            foreach ($journal->cdj_sundry_data ?: [] as $accountCode) { // Ensure sundry data is treated as an array
                $totalDebit += $accountCode->cdj_debit ?? 0;
                $totalCredit += $accountCode->cdj_credit ?? 0;
            }
        }

        $this->totalDebit = $totalDebit;
        $this->totalCredit = $totalCredit;
    }

    public function render()
    {
        $query = CashDisbursementJournalModel::query();

        $this->totalsCashDisbursementJournal($query);

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('cdj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        $query->when($this->search, function ($query) {
            $query->where(function ($query) {
                $query->orWhere('cdj_jevnum', 'like', '%' . $this->search . '%')
                      ->orWhere('cdj_entrynum_date', 'like', '%' . $this->search . '%')
                      ->orWhere('cdj_referencenum', 'like', '%' . $this->search . '%')
                      ->orWhere('cdj_bur', 'like', '%' . $this->search . '%')
                      ->orWhere('cdj_accountable_officer', 'like', '%' . $this->search . '%')
                      ->orWhere('cdj_credit_accountcode', 'like', '%' . $this->search . '%')
                      ->orWhere('cdj_amount', 'like', '%' . $this->search . '%')
                      ->orWhere('cdj_account1', 'like', '%' . $this->search . '%')
                      ->orWhere('cdj_account2', 'like', '%' . $this->search . '%')
                      ->orWhereHas('cdj_sundry_data', function ($subQuery) {
                          $subQuery->where('cdj_sundry_accountcode', 'like', '%' . $this->search . '%')
                                   ->orWhere('cdj_pr', 'like', '%' . $this->search . '%')
                                   ->orWhere('cdj_debit', 'like', '%' . $this->search . '%')
                                   ->orWhere('cdj_credit', 'like', '%' . $this->search . '%');
                      });
            });
        });

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $this->totalAmount = $query->sum('cdj_amount');
        $this->totalAccount1 = $query->sum('cdj_account1');
        $this->totalAccount2 = $query->sum('cdj_account2');

        // Get paginated results
        $cash_disbursement_journal = $query->get();
        return view('livewire.cash-disbursement-journal-show',['cash_disbursement_journal' => $cash_disbursement_journal]);
    }
}