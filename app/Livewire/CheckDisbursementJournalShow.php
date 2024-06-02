<?php

namespace App\Livewire;

use App\Exports\CheckDisbursementJournalExport;
use App\Imports\CheckDisbursementJournalImport;
use App\Models\CheckDisbursementJournalModel;
use App\Models\CKDJ_SundryModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;
use App\Models\ledgerSheetModel;

class CheckDisbursementJournalShow extends Component
{
   
    use WithFileUploads;

    public $ckdj_entrynum_date,
    $checkdisbursementjournal_no,
    $ckdj_jevnum,
    $ckdj_checknum,
    $ckdj_payee,
    $ckdj_bur,
    $ckdj_cib_lcca,
    $ckdj_account1,
    $ckdj_account2,
    $ckdj_account3,
    $ckdj_salary_wages,
    $ckdj_honoraria,
    $ckdj_sundry_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $selectedMonth;
    public $sortField = 'checkdisbursementjournal_no'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $softDeletedData;
    public $file;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $totalCib = 0;
    public $totalAccount1 = 0;
    public $totalAccount2 = 0;
    public $totalAccount3 = 0;
    public $totalSalaryWages = 0;
    public $totalHonoraria = 0;
    public $totalAccountCode = 0;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

    protected function rules()
    {
        return [
            'ckdj_entrynum_date'=>'required|nullable|date',
            'ckdj_jevnum'=>'nullable|string', 
            'ckdj_checknum'=>'nullable|string',
            'ckdj_payee'=>'nullable|string',
            'ckdj_bur'=>'nullable|string',
            'ckdj_cib_lcca'=> 'nullable|numeric|min:0|max:1000000000',
            'ckdj_account1'=> 'nullable|numeric|min:0|max:1000000000',
            'ckdj_account2'=> 'nullable|numeric|min:0|max:1000000000',
            'ckdj_account3'=> 'nullable|numeric|min:0|max:1000000000',
            'ckdj_salary_wages'=> 'nullable|numeric|min:0|max:1000000000',
            'ckdj_honoraria'=> 'nullable|numeric|min:0|max:1000000000',
            'ckdj_sundry_data' => 'required|array|min:1',
            'ckdj_sundry_data.*.ckdj_accountcode'=>'nullable|string', //@korinlv: edited this
            'ckdj_sundry_data.*.ckdj_debit'=> 'nullable|numeric|min:0|max:10000000000',
            'ckdj_sundry_data.*.ckdj_credit'=> 'nullable|numeric|min:0|max:10000000000',
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
        $journal = CheckDisbursementJournalModel::find($this->checkdisbursementjournal_no);

        if ($journal && $journal->ckdj_sundry_data()->exists()) {
            // If there is existing sundry data in the database, load it
            $this->ckdj_sundry_data = $journal->ckdj_sundry_data->toArray();
        } else {
            // If the database is empty, initialize with an empty structure
            $this->ckdj_sundry_data = [
                ['ckdj_accountcode' => '', 'ckdj_debit' => '', 'ckdj_credit' => '']
            ];
        }
    }

    //@korinlv: updated this function
    public function saveCheckDisbursementJournal()
    {
        $validatedData = $this->validate();
        // Convert empty strings to null for the main journal data
        $validatedData = array_map(function($value) {
            return $value === '' ? null : $value;
        }, $validatedData);

        $journal = CheckDisbursementJournalModel::create($validatedData);

        foreach ($validatedData['ckdj_sundry_data'] as $code) {
            // Convert empty strings to null for each sundry data entry
            $code = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $code);

            $journal->ckdj_sundry_data()->create([
                'ckdj_accountcode' => $code['ckdj_accountcode'],
                'ckdj_debit' => $code['ckdj_debit'],
                'ckdj_credit' => $code['ckdj_credit'],
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
            'ckdj_sundry_data.*.ckdj_accountcode'=>'nullable|string', //@korinlv: edited this
            'ckdj_sundry_data.*.ckdj_debit'=> 'nullable|numeric|min:0|max:10000000000',
            'ckdj_sundry_data.*.ckdj_credit'=> 'nullable|numeric|min:0|max:10000000000',
        ]);
    
        foreach ($this->ckdj_sundry_data as $code) {
            $debit = $code['ckdj_debit'] ?? null; // Default to the provided debit value
            $credit = $code['ckdj_credit'] ?? null; // Default to the provided credit value
    
            switch ($code['ckdj_accountcode']) {
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
    
            ledgerSheetModel::create([
                'ls_vouchernum' => $this->ckdj_jevnum, 
                'ls_date' => $this->ckdj_entrynum_date, 
                'ls_particulars' => $this->ckdj_payee, 
                'ls_accountname' => $code['ckdj_accountcode'], 
                'ls_debit' => $debit, 
                'ls_credit' => $credit, 
                'ls_credit_balance' => null,
                'ls_balance_debit' => null
            ]);
        }
    }

    //@korinlv: added this function
    public function addAccountCode()
    {
        $this->ckdj_sundry_data[] = ['ckdj_accountcode' => '', 'ckdj_debit' => '', 'ckdj_credit' => ''];
        logger('Account code added', $this->ckdj_sundry_data);
    }

    //@korinlv: added this function
    public function removeAccountCode($index)
    {
        unset($this->ckdj_sundry_data[$index]);
        $this->ckdj_sundry_data = array_values($this->ckdj_sundry_data);
        logger('Account code removed', $this->ckdj_sundry_data);
    }


    //@korinlv: updated this function
    public function editCheckDisbursementJournal($checkdisbursementjournal_no)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::with('ckdj_sundry_data')->find($checkdisbursementjournal_no);
        if ($check_disbursement_journal) {

            $this->checkdisbursementjournal_no = $check_disbursement_journal->$checkdisbursementjournal_no;
            $this->ckdj_checknum = $check_disbursement_journal->ckdj_checknum;
            $this->ckdj_jevnum = $check_disbursement_journal->ckdj_jevnum;
            $this->ckdj_entrynum_date = $check_disbursement_journal->ckdj_entrynum_date;
            $this->ckdj_payee = $check_disbursement_journal->ckdj_payee;
            $this->ckdj_bur = $check_disbursement_journal->ckdj_bur;
            $this->ckdj_cib_lcca = $check_disbursement_journal->ckdj_cib_lcca;
            $this->ckdj_account1 = $check_disbursement_journal->ckdj_account1;
            $this->ckdj_account2 = $check_disbursement_journal->ckdj_account2;
            $this->ckdj_account3 = $check_disbursement_journal->ckdj_account3;
            $this->ckdj_salary_wages = $check_disbursement_journal->ckdj_salary_wages;
            $this->ckdj_honoraria = $check_disbursement_journal->ckdj_honoraria;

            $this->ckdj_sundry_data = $check_disbursement_journal->ckdj_sundry_data->toArray();
        } 
    }

    //@korinlv: edited this function
    //@marii eto yung function na inupdate ko 
    public function updateCheckDisbursementJournal()
    {
        $validatedData = $this->validate([
            'ckdj_entrynum_date' => 'nullable|date',
            'ckdj_jevnum' => 'nullable|string',
            'ckdj_checknum' => 'nullable|string',
            'ckdj_payee' => 'nullable|string',
            'ckdj_bur' => 'nullable|string',
            'ckdj_cib_lcca' => 'nullable|numeric',
            'ckdj_account1' => 'nullable|numeric',
            'ckdj_account2' => 'nullable|numeric',
            'ckdj_account3' => 'nullable|numeric',
            'ckdj_salary_wages' => 'nullable|numeric',
            'ckdj_honoraria' => 'nullable|numeric',
            'ckdj_sundry_data' => 'required|array|min:1',
            'ckdj_sundry_data.*.ckdj_accountcode' => 'nullable|string',
            'ckdj_sundry_data.*.ckdj_debit' => 'nullable|numeric|min:0|max:100000000',
            'ckdj_sundry_data.*.ckdj_credit' => 'nullable|numeric|min:0|max:100000000',
        ]);

            // Convert empty strings to null in the main journal data
            $validatedData = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $validatedData);

            $journal = CheckDisbursementJournalModel::findOrFail($this->checkdisbursementjournal_no);
            $journal->update($validatedData);

            // Get existing sundry data IDs
            $existingSundryIds = $journal->ckdj_sundry_data->pluck('ckdj_id')->toArray();

            // Prepare an array to hold the IDs of incoming sundry data
            $incomingSundryIds = [];

            foreach ($this->ckdj_sundry_data as $data) {
                // Convert empty strings to null for each sundry data entry
                $data = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $data);

                if (isset($data['ckdj_id']) && $data['ckdj_id']) {
                    // Update existing account code
                    $accountCode = CKDJ_SundryModel::find($data['ckdj_id']);
                    if ($accountCode) {
                        $accountCode->update($data);
                        $incomingSundryIds[] = $data['ckdj_id'];
                    }
                } else {
                    // Create new account code
                    $newAccountCode = $journal->ckdj_sundry_data()->create($data);
                    $incomingSundryIds[] = $newAccountCode->ckdj_id;

                    // Reset other fields except the newly added sundry entry
                    $this->ckdj_sundry_data[] = ['ckdj_accountcode' => '', 'ckdj_debit' => '', 'ckdj_credit' => ''];
                }
            }

            // Calculate sundry data IDs to delete (those that are not in the incoming data)
            $sundryIdsToDelete = array_diff($existingSundryIds, $incomingSundryIds);

            // Delete sundry data not in the incoming data
            CKDJ_SundryModel::destroy($sundryIdsToDelete);

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
        $this->ckdj_entrynum_date = '';            
        $this->ckdj_checknum = '';    
        $this->ckdj_jevnum = '';    
        $this->ckdj_payee = '';
        $this->ckdj_bur = '';
        $this->ckdj_cib_lcca = '';
        $this->ckdj_account1 = '';
        $this->ckdj_account2 = '';
        $this->ckdj_account3 = '';
        $this->ckdj_salary_wages = '';
        $this->ckdj_honoraria = '';
        $this->ckdj_sundry_data = []; 

    }

    // Soft delete CheckDisbursementJournal
    //@korinlv: edited this function
    public function softDeleteCheckDisbursementJournal($checkdisbursementjournal_no)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::with('ckdj_sundry_data')->find($checkdisbursementjournal_no);
        if ($check_disbursement_journal) {
            // Delete the related sundries first
            foreach ($check_disbursement_journal->ckdj_sundry_data as $sundry) {
                $sundry->delete();
            }

        // Now soft delete the journal
        $check_disbursement_journal->delete();
        session()->flash('message', 'Soft Deleted Successfully');
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

    public function importCKDJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new CheckDisbursementJournalImport, $filePath);

        return redirect()->back();
        }
    }
    
    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function exportCKDJ_XLSX(Request $request) 
    {
        return Excel::download(new CheckDisbursementJournalExport, 'CKDJ.xlsx');
    }
    // @korin: edited this function
    public function exportCKDJ_CSV(Request $request) 
    {
        return Excel::download(new CheckDisbursementJournalExport, 'CKDJ.csv');
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

    public function totalsCheckDisbursementJournal($query){
        //@korinlv:added this function
        $check_disbursement_journals = $query->with(['ckdj_sundry_data' => function ($query) {
        }])->get();
        
        $totalDebit = 0;
        $totalCredit = 0;

        foreach ($check_disbursement_journals as $journal) {
            foreach ($journal->ckdj_sundry_data ?: [] as $sundry) { // Ensure sundry data is treated as an array
                $totalDebit += $sundry->ckdj_debit ?? 0;
                $totalCredit += $sundry->ckdj_credit ?? 0;
            }
        }
    
        $this->totalDebit = $totalDebit;
        $this->totalCredit = $totalCredit;
    }

    // Render the component
    public function render()
    {
        $query = CheckDisbursementJournalModel::query();

        $this->totalsCheckDisbursementJournal($query);
    
        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
    
            $query->whereBetween('ckdj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }
    
        // Add the search filter
        // $query->where('id', 'like', '%' . $this->search . '%');

        // @korin: edited this function
        // @vince eto inedit ko
        $query->where(function ($q) {
            $q->where('ckdj_checknum', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_checknum', 'like', '%' . $this->search . '%')
                ->orWhere('ckdj_entrynum_date', 'like', '%' . $this->search . '%')
                ->orWhere('ckdj_jevnum', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_payee', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_bur', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_cib_lcca', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_account1', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_account2', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_account3', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_salary_wages', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_honoraria', 'like', '%' . $this->search . '%')
              ->orWhereHas('ckdj_sundry_data', function ($q) {
                $q->where('ckdj_accountcode', 'like', '%' . $this->search . '%')
                  ->orWhere('ckdj_debit', 'like', '%' . $this->search . '%')
                  ->orWhere('ckdj_credit', 'like', '%' . $this->search . '%');
              });
        });
    
        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $this->totalCib = $query->sum('ckdj_cib_lcca');
        $this->totalAccount1 = $query->sum('ckdj_account1');
        $this->totalAccount2 = $query->sum('ckdj_account2');
        $this->totalAccount3 = $query->sum('ckdj_account3');
        $this->totalSalaryWages = $query->sum('ckdj_salary_wages');
        $this->totalHonoraria = $query->sum('ckdj_honoraria');

        $check_disbursement_journal = $query->get();
    
        return view('livewire.check-disbursement-journal-show', ['check_disbursement_journal' => $check_disbursement_journal]);
    }
}