<?php

namespace App\Livewire;

use App\Exports\GeneralJournalExport;
use App\Imports\GeneralJournalImport;
use App\Models\GeneralJournalModel;
use App\Models\GeneralJournal_AccountCodesModel; //@korinlv: added  this
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;
use App\Models\LedgerSheetModel;

class GeneralJournalShow extends Component
{
    use WithFileUploads;
    
    public $gj_entrynum_date,
    $generaljournal_no,
    $gj_jevnum,
    $gj_particulars,
    $gj_accountcodes_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $selectedMonth;
    public $sortField = 'generaljournal_no'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

    // Validation rules
    //@korin:edited this
    protected function rules()
    {
        return [
            'gj_entrynum_date' => 'required|nullable|date',
            'gj_jevnum' => 'nullable|string',
            'gj_particulars' => 'nullable|string',
            'gj_accountcodes_data' => 'required|array|min:1',
            'gj_accountcodes_data.*.gj_accountcode' => 'nullable|string',
            'gj_accountcodes_data.*.gj_debit' => 'nullable|numeric|min:0|max:10000000000',
            'gj_accountcodes_data.*.gj_credit' => 'nullable|numeric|min:0|max:10000000000',
        ];
    }

    // Validate when fields are updated
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    //@korinlv: added this function
    public function mount()
    {
        // Fetch existing sundry data for the given journal ID
        $journal = GeneralJournalModel::find($this->generaljournal_no);

        if ($journal && $journal->gj_accountcodes_data()->exists()) {
            // If there is existing sundry data in the database, load it
            $this->gj_accountcodes_data = $journal->gj_accountcodes_data->toArray();
        } else {
            // Example initialization, you might load this from a database or start with an empty array
            $this->gj_accountcodes_data = [
                ['gj_accountcode' => '', 'gj_debit' => '', 'gj_credit' => '']
            ];
        }
    }
    
    // Save new GeneralJournal
    //@korinlv: updated this function
    public function saveGeneralJournal()
    {
        $validatedData = $this->validate();

        // Convert empty strings to null for the main journal data
        $validatedData = array_map(function($value) {
            return $value === '' ? null : $value;
        }, $validatedData);

        $journal = GeneralJournalModel::create($validatedData);

        foreach ($validatedData['gj_accountcodes_data'] as $code) {
            // Convert empty strings to null for each sundry data entry
            $code = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $code);

            $journal->gj_accountcodes_data()->create([
                'gj_accountcode' => $code['gj_accountcode'],
                'gj_debit' => $code['gj_debit'],
                'gj_credit' => $code['gj_credit'],
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
            'gj_accountcodes_data.*.gj_accountcode' => 'required|string|max:255', // Validate the account code
            'gj_accountcodes_data.*.gj_debit' => 'nullable|numeric', // Validate the debit amount
            'gj_accountcodes_data.*.gj_credit' => 'nullable|numeric', // Validate the credit amount
        ]);
    
        foreach ($this->gj_accountcodes_data as $code) {
            $debit = $code['gj_debit'] ?? null; // Default to the provided debit value
            $credit = $code['gj_credit'] ?? null; // Default to the provided credit value
    
            switch ($code['gj_accountcode']) {
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
                'ls_vouchernum' => $this->gj_jevnum, // Use journal entry voucher number
                'ls_date' => $this->gj_entrynum_date, // Use the date from the journal entry
                'ls_particulars' => $this->gj_particulars, // Use the particulars from the journal entry
                'ls_accountname' => $code['gj_accountcode'], // The account code from the input
                'ls_debit' => $debit, // Debit amount, modified conditionally
                'ls_credit' => $credit, // Credit amount, modified conditionally
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
        $this->gj_accountcodes_data[] = ['gj_accountcode' => '', 'gj_debit' => '', 'gj_credit' => ''];
        logger('Account code added', $this->gj_accountcodes_data);
    }

    public function removeAccountCode($index)
    {
        unset($this->gj_accountcodes_data[$index]);
        $this->gj_accountcodes_data = array_values($this->gj_accountcodes_data);
        logger('Account code removed', $this->gj_accountcodes_data);
    }

    // Edit GeneralJournal
    //@korinlv: updated this function
    public function editGeneralJournal($generaljournal_no)
    {
        $generalJournal = GeneralJournalModel::with('gj_accountcodes_data')->find($generaljournal_no);
        if ($generalJournal) {
            $this->generaljournal_no = $generalJournal->generaljournal_no;

            $this->gj_jevnum = $generalJournal->gj_jevnum;
            $this->gj_entrynum_date = $generalJournal->gj_entrynum_date;
            $this->gj_particulars = $generalJournal->gj_particulars;
            // Handle related data as array of objects or similar structure
            $this->gj_accountcodes_data = $generalJournal->gj_accountcodes_data->toArray();
        } 
    }
   // Update GeneralJournal
    //@korinlv: edited this function
    //@marii eto yung function na inupdate ko 
    public function updateGeneralJournal()
    {
        $validatedData = $this->validate([
            'gj_entrynum_date' => 'nullable|date',
            'gj_jevnum' => 'nullable|string',
            'gj_particulars' => 'nullable|string',
            'gj_accountcodes_data.*.gj_accountcode' => 'required|string',
            'gj_accountcodes_data.*.gj_debit' => 'nullable|numeric',
            'gj_accountcodes_data.*.gj_credit' => 'nullable|numeric',
        ]);

            // Convert empty strings to null in the main journal data
            $validatedData = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $validatedData);

            $generalJournal = GeneralJournalModel::findOrFail($this->generaljournal_no);
            $generalJournal->update($validatedData);

            // Get existing sundry data IDs
            $existingSundryIds = $generalJournal->gj_accountcodes_data->pluck('gj_id')->toArray();

            // Prepare an array to hold the IDs of incoming sundry data
            $incomingSundryIds = [];

            foreach ($this->gj_accountcodes_data as $data) {
                // Convert empty strings to null for each sundry data entry
                $data = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $data);

                if (isset($data['gj_id']) && $data['gj_id']) {
                    // Update existing account code
                    $accountCode = GeneralJournal_AccountCodesModel::find($data['gj_id']);
                    if ($accountCode) {
                        $accountCode->update($data);
                        $incomingSundryIds[] = $data['gj_id'];
                    }
                } else {
                    // Create new account code
                    $newAccountCode = $generalJournal->gj_accountcodes_data()->create($data);
                    $incomingSundryIds[] = $newAccountCode->gj_id;

                    // Reset other fields except the newly added sundry entry
                    $this->gj_accountcodes_data[] = ['gj_accountcode' => '', 'gj_debit' => '', 'gj_credit' => ''];
                }
            }

        // Calculate sundry data IDs to delete (those that are not in the incoming data)
        $sundryIdsToDelete = array_diff($existingSundryIds, $incomingSundryIds);

        // Delete sundry data not in the incoming data
        GeneralJournal_AccountCodesModel ::destroy($sundryIdsToDelete);

        // Update notification state
        $this->notificationMessage = 'Updated Successfully';
        $this->showNotification = true;
        $this->resetInput();

        // Dispatch browser event to handle notification visibility
        $this->dispatch('notification-shown');

        $this->dispatch('close-modal');
    }

    // Close modal and reset input
    public function closeModal()
    {
        $this->resetInput();
    }

    // Reset input values
    //@korinlv: edited this function
    public function resetInput()
    {
        $this->gj_entrynum_date = '';
        $this->gj_jevnum = '';
        $this->gj_particulars = '';
        $this->gj_accountcodes_data = [];
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

    public function softDeleteGeneralJournal($generaljournal_no)
    {
        $general_journal = GeneralJournalModel::with('gj_accountcodes_data')->find($generaljournal_no);
        if ($general_journal) {
            // Delete the related sundries first
            foreach ($general_journal->gj_accountcodes_data as $sundry) {
                $sundry->delete();
            }

        // Now soft delete the journal
        $general_journal->delete();
        session()->flash('message', 'Soft Deleted Successfully');
    }

        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function importGJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new GeneralJournalImport, $filePath);

        return redirect('/GJ');
        }
    }

    // @korin: edited this function
    public function exportGJ_XLSX(Request $request) 
    {
        return Excel::download(new GeneralJournalExport, 'GJ.xlsx');
    }
    public function exportGJ_CSV(Request $request) 
    {
        return Excel::download(new GeneralJournalExport, 'GJ.csv');
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

    public function totalsGeneralJournal($query){
        //@korinlv:added this function
        $general_journals = $query->with(['gj_accountcodes_data' => function($query){}])->get();
        
        $totalDebit = 0;
        $totalCredit = 0;

        foreach ($general_journals as $journal) {
            foreach ($journal->gj_accountcodes_data ?: [] as $accountCode) { // Ensure sundry data is treated as an array
                $totalDebit += $accountCode->gj_debit ?? 0;
                $totalCredit += $accountCode->gj_credit ?? 0;
            }
        }
    
        $this->totalDebit = $totalDebit;
        $this->totalCredit = $totalCredit;

    }

    // Render the component
    public function render()
    {
        $query = GeneralJournalModel::query();

        $this->totalsGeneralJournal($query);
        
        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('gj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }

        // Add the search filter
        $query->when($this->search, function ($query) {
            $query->where(function ($query) {
                $query->orWhere('gj_entrynum_date', 'like', '%' . $this->search . '%')
                      ->orWhere('gj_jevnum', 'like', '%' . $this->search . '%')
                      ->orWhere('gj_particulars', 'like', '%' . $this->search . '%')
                      ->orWhereHas('gj_accountcodes_data', function ($subQuery) {
                          $subQuery->where('gj_accountcode', 'like', '%' . $this->search . '%');
                      });
            });
        });

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        $general_journal = $query->orderBy('gj_jevnum', 'ASC')->get(); // Changed from paginate() to get()

        return view('livewire.general-journal-show', ['general_journal' => $general_journal]);
    }
}