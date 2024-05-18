<?php

namespace App\Livewire;

use App\Exports\GeneralJournalExport;
use App\Imports\GeneralJournalImport;
use Livewire\WithPagination;
use App\Models\GeneralJournalModel;
use App\Models\GeneralJournal_AccountCodesModel; //@korinlv: added  this
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Carbon\Carbon;



class GeneralJournalShow extends Component
{
    use WithPagination;
    use WithFileUploads;
    

    protected $paginationTheme = 'bootstrap';

    public $gj_entrynum_date,
    $gj_jevnum,
    $gj_particulars,
    $gj_accountcodes_data = [], //@korinlv: added this
    $deleteType; // Added deleteType property

    public $search;
    public $general_journal_id; // Add this property
    public $selectedMonth;
    public $sortField = 'gj_entrynum_date'; // New property for sorting //ITO YUNG DINAGDAG SA SORTINGGGG
    public $sortDirection = 'asc'; // New property for sorting // KASAMA TOO
    public $file;
    public $softDeletedData;
    public $totalDebit = 0;
    public $totalCredit = 0;
    public $viewDeleted = false; // Property to toggle deleted records view

    // Validation rules
    //@korin:edited this
    protected function rules()
    {
        return [
            'gj_entrynum_date' => 'nullable|date',
            'gj_jevnum' => 'nullable|integer',
            'gj_particulars' => 'nullable|string',
            'gj_accountcodes_data' => 'required|array|min:1',
            'gj_accountcodes_data.*.gj_accountcode' => 'required|string',
            'gj_accountcodes_data.*.gj_debit' => 'nullable|numeric',
            'gj_accountcodes_data.*.gj_credit' => 'nullable|numeric',
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
        $journal = GeneralJournalModel::find($this->general_journal_id);

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

        session()->flash('message', 'Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
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
    public function editGeneralJournal($general_journal_id)
    {
        $generalJournal = GeneralJournalModel::with('gj_accountcodes_data')->find($general_journal_id);
        if ($generalJournal) {
            $this->general_journal_id = $generalJournal->id;
            $this->gj_entrynum_date = $generalJournal->gj_entrynum_date;
            $this->gj_jevnum = $generalJournal->gj_jevnum;
            $this->gj_particulars = $generalJournal->gj_particulars;

            // Handle related data as array of objects or similar structure
            $this->gj_accountcodes_data = $generalJournal->gj_accountcodes_data->toArray();
        } else {
            return redirect()->to('/GJ');
        }
    }


    // Update GeneralJournal
    //@korinlv: edited this function
    //@marii eto yung function na inupdate ko 
    public function updateGeneralJournal()
    {
        $validatedData = $this->validate([
            'gj_entrynum_date' => 'nullable|date',
            'gj_jevnum' => 'nullable|numeric',
            'gj_particulars' => 'nullable|string',
            'gj_accountcodes_data.*.gj_accountcode' => 'required|string',
            'gj_accountcodes_data.*.gj_debit' => 'nullable|numeric',
            'gj_accountcodes_data.*.gj_credit' => 'nullable|numeric',
        ]);

        try {
            // Convert empty strings to null in the main journal data
            $validatedData = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $validatedData);

            $generalJournal = GeneralJournalModel::findOrFail($this->general_journal_id);
            $generalJournal->update($validatedData);

            // Get existing sundry data IDs
            $existingSundryIds = $generalJournal->gj_accountcodes_data->pluck('id')->toArray();

            // Prepare an array to hold the IDs of incoming sundry data
            $incomingSundryIds = [];

            foreach ($this->gj_accountcodes_data as $data) {
                // Convert empty strings to null for each sundry data entry
                $data = array_map(function($value) {
                    return $value === '' ? null : $value;
                }, $data);

                if (isset($data['id']) && $data['id']) {
                    // Update existing account code
                    $accountCode = GeneralJournal_AccountCodesModel::find($data['id']);
                    if ($accountCode) {
                        $accountCode->update($data);
                        $incomingSundryIds[] = $data['id'];
                    }
                } else {
                    // Create new account code
                    $newAccountCode = $generalJournal->gj_accountcodes_data()->create($data);
                    $incomingSundryIds[] = $newAccountCode->id;

                    // Reset other fields except the newly added sundry entry
                    $this->gj_accountcodes_data[] = ['gj_accountcode' => '', 'gj_debit' => '', 'gj_credit' => ''];
                }
            }

                // Calculate sundry data IDs to delete (those that are not in the incoming data)
                $sundryIdsToDelete = array_diff($existingSundryIds, $incomingSundryIds);

                // Delete sundry data not in the incoming data
                GeneralJournal_AccountCodesModel ::destroy($sundryIdsToDelete);

            session()->flash('message', 'Updated Successfully');
        } catch (\Exception $e) {
            session()->flash('error', "Failed to update: " . $e->getMessage());
        }
        
            $this->resetInput();  // Reset all properties
            $this->dispatch('close-modal');  // Assume you mean $this->emit to use Livewire's event system
        }


    // Delete GeneralJournal
    public function deleteGeneralJournal(int $general_journal_id, $type = 'soft')
    {
        $this->general_journal_id = $general_journal_id;
        $this->deleteType = $type; // Set the delete type
    }

    // Permanently delete 
    public function destroyGeneralJournal()
    {
        $general_journal = GeneralJournalModel::withTrashed()->find($this->general_journal_id);
        if ($this->deleteType == 'force') {
            $general_journal->forceDelete();
            session()->flash('message', 'Permanently Deleted Successfully');
        } else {
            $general_journal->delete();
            session()->flash('message', 'Soft Deleted Successfully');
        }
        
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    // Close modal and reset input
    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('close-modal');
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

    //@korinlv: edited this function
    public function softDeleteGeneralJournal($general_journal_id)
    {
        $general_journal= GeneralJournalModel::find($general_journal_id);
        if ( $general_journal) {
            foreach ($general_journal->gj_accountcodes_data as $accountCode){
                $accountCode->delete();
            }
            
            $general_journal->delete();
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

    public function importGJ()
    {
    // Ensure that a file has been uploaded
        if ($this->file) {
        $filePath = $this->file->store('files');

        Excel::import(new GeneralJournalImport, $filePath);

        return redirect()->back()->with('success', 'Data imported successfully');
        }
    }
    
    public function importViewGJ(){
        return view('journals.GJ');
    }

    //ITO NAMAN SA EXPORT GUMAGANA TO SO CHANGE THE VARIABLES ACCORDING TO THE JOURNALS
    public function exportGJ(Request $request) 
    {
        return Excel::download(new GeneralJournalExport, 'GJ.xlsx');
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
    
    // Method to toggle viewDeleted
    public function toggleDeletedView()
    {
        $this->viewDeleted = !$this->viewDeleted;
    }

    // Method to restore soft-deleted record
    //@korinlv: edited this function
    public function restoreGeneralJournal($id)
    {
        $general_journal = GeneralJournalModel::onlyTrashed()->find($id);
        if ($general_journal) {
            $trashedAccountCodes = $general_journal->gj_accountcodes_data()->onlyTrashed()->get();
            foreach ($trashedAccountCodes as $accountCode){
                $accountCode->restore();
            }
            $general_journal->restore();
            session()->flash('message', 'Record restored successfully.');
        }
    }

    // Render the component
    public function render()
    {
        $query = GeneralJournalModel::query();
        

        // Fetch only soft-deleted records if viewDeleted is set to true
        if ($this->viewDeleted) {
            $query = $query->onlyTrashed(); // Fetch only soft-deleted records
        }

        // Apply the month filter if a month is selected
        if ($this->selectedMonth) {
            $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::parse($this->selectedMonth)->endOfMonth();
            
            $query->whereBetween('gj_entrynum_date', [$startOfMonth, $endOfMonth]);
        }

        //@korinlv:added this function
        $general_journals = $query->with(['gj_accountcodes_data' => function($query){
            if ($this->viewDeleted) {
                $query->onlyTrashed();
            }
        }])->get();
        
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

        // Add the search filter
        $query->where('id', 'like', '%' . $this->search . '%');

        // Apply sorting ITO PA KORINNE SA SORT DIN TO SO COPY MO LANG TO SA IBANG JOURNALS HA?
        $query->orderBy($this->sortField , $this->sortDirection);

        // Get paginated results
        $general_journal = $query->paginate(10);

         // Compute the total debit and credit for the selected month

        return view('livewire.general-journal-show', ['general_journal' => $general_journal]);
    }
}