<?php

namespace App\Livewire;

use App\Exports\CheckDisbursementJournalExport;
use App\Imports\CheckDisbursementJournalImport;
use Livewire\WithPagination;
use App\Models\CheckDisbursementJournalModel;
use App\Models\CKDJ_SundryModel;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;

class CheckDisbursementJournalShow extends Component
{
   
    use WithFileUploads;

    public $ckdj_entrynum_date,
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
    public $check_disbursement_journal_id;
    public $selectedMonth;
    public $sortField = 'ckdj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
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
    public $viewDeleted = false; // Property to toggle deleted records view
    public $showNotification = false; // Control notification visibility
    public $notificationMessage = ''; // Store the notification message

    protected function rules()
    {
        return [
            'ckdj_entrynum_date'=>'nullable|date',
            'ckdj_checknum'=>'nullable|integer',
            'ckdj_payee'=>'nullable|string',
            'ckdj_bur'=>'nullable|integer',
            'ckdj_cib_lcca'=> 'nullable|numeric',
            'ckdj_account1'=> 'nullable|numeric',
            'ckdj_account2'=> 'nullable|numeric',
            'ckdj_account3'=> 'nullable|numeric',
            'ckdj_salary_wages'=> 'nullable|numeric',
            'ckdj_honoraria'=> 'nullable|numeric',
            'ckdj_sundry_data' => 'required|array|min:1',
            'ckdj_sundry_data.*.ckdj_accountcode'=>'nullable|string', //@korinlv: edited this
            'ckdj_sundry_data.*.ckdj_debit'=> 'nullable|numeric|min:0|max:100000000',
            'ckdj_sundry_data.*.ckdj_credit'=> 'nullable|numeric|min:0|max:100000000',
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
        $journal = CheckDisbursementJournalModel::find($this->check_disbursement_journal_id);

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
    public function editCheckDisbursementJournal($check_disbursement_journal_id)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::with('ckdj_sundry_data')->find($check_disbursement_journal_id);
        if ($check_disbursement_journal) {

            $this->check_disbursement_journal_id = $check_disbursement_journal->id;
            $this->ckdj_entrynum_date = $check_disbursement_journal->ckdj_entrynum_date;
            $this->ckdj_checknum = $check_disbursement_journal->ckdj_checknum;
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
        else {
            return redirect() -> to('/CKDJ'); 
        }
    }

    //@korinlv: edited this function
    //@marii eto yung function na inupdate ko 
    public function updateCheckDisbursementJournal()
    {
        $validatedData = $this->validate([
            'ckdj_entrynum_date' => 'nullable|date',
            'ckdj_checknum' => 'nullable|integer',
            'ckdj_payee' => 'nullable|string',
            'ckdj_bur' => 'nullable|integer',
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

            $journal = CheckDisbursementJournalModel::findOrFail($this->check_disbursement_journal_id);
            $journal->update($validatedData);

            // Get existing sundry data IDs
            $existingSundryIds = $journal->ckdj_sundry_data->pluck('id')->toArray();

            // Prepare an array to hold the IDs of incoming sundry data
            $incomingSundryIds = [];

            foreach ($this->ckdj_sundry_data as $data) {
                // Convert empty strings to null for each sundry data entry
                $data = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $data);

                if (isset($data['id']) && $data['id']) {
                    // Update existing account code
                    $accountCode = CKDJ_SundryModel::find($data['id']);
                    if ($accountCode) {
                        $accountCode->update($data);
                        $incomingSundryIds[] = $data['id'];
                    }
                } else {
                    // Create new account code
                    $newAccountCode = $journal->ckdj_sundry_data()->create($data);
                    $incomingSundryIds[] = $newAccountCode->id;

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

    // Delete CheckDisbursementJournal
    public function deleteCheckDisbursementJournal(int $check_disbursement_journal_id, $type = 'soft')
    {
        $this->check_disbursement_journal_id = $check_disbursement_journal_id;
        $this->deleteType = $type; // Set the delete type
    }

    //permanently delete CheckDisbursementJournal
    public function destroyCheckDisbursementJournal()
    {
        $check_disbursement_journal_id = CheckDisbursementJournalModel::withTrashed()->find($this->check_disbursement_journal_id);
        if ($this->deleteType == 'force') {
            $check_disbursement_journal_id->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $check_disbursement_journal_id->delete();
            session()->flash('message', 'Soft Deleted Successfully');
        }
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    //@korinlv: edited this function
    public function resetInput()
    {
        $this->check_disbursement_journal_id = '';
        $this->ckdj_entrynum_date = '';            
        $this->ckdj_checknum = '';        
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
    public function softDeleteCheckDisbursementJournal($check_disbursement_journal_id)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::with('ckdj_sundry_data')->find($check_disbursement_journal_id);
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

    public function importViewCKDJ(){
        return view('journals.CKDJ');
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

    // Method to toggle viewDeleted
    public function toggleDeletedView()
    {
        $this->viewDeleted = !$this->viewDeleted;
    }

    // Method to restore soft-deleted record
    //@korinlv: edited this function
    public function restoreCheckDisbursementJournal($id)
    {
        $check_disbursement_journal = CheckDisbursementJournalModel::onlyTrashed()->find($id);
        if ($check_disbursement_journal) {
            // Load trashed sundries
            $trashedSundries = $check_disbursement_journal->ckdj_sundry_data()->onlyTrashed()->get();
            foreach ($trashedSundries as $sundry){
                $sundry->restore();
            }

            $check_disbursement_journal->restore();
            session()->flash('message', 'Record restored successfully.');
        }
    }

    // Render the component
    public function render()
    {
        $query = CheckDisbursementJournalModel::query();

        // Fetch only soft-deleted records if viewDeleted is set to true
        if ($this->viewDeleted) {
            $query = $query->onlyTrashed(); // Fetch only soft-deleted records
        }

        //@korinlv:added this function
        $check_disbursement_journals = $query->with(['ckdj_sundry_data' => function ($query) {
            if ($this->viewDeleted) {
                $query->onlyTrashed();
            }
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
            $q->where('id', 'like', '%' . $this->search . '%')
              ->orWhere('ckdj_checknum', 'like', '%' . $this->search . '%')
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

        

        // Get paginated results with eager loading of 'sundries' relationship
        $check_disbursement_journal = $query->get();
    
        return view('livewire.check-disbursement-journal-show', ['check_disbursement_journal' => $check_disbursement_journal]);
    }
}