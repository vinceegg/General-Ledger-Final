<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CheckDisbursementJournalModel;
use App\Models\CashDisbursementJournalModel;
use App\Models\CashReceiptJournalModel;
use App\Models\GeneralJournalModel;

class Charts extends Component
{
    public 
    $ckdj_totalDebit = 0,
    $cdj_totalDebit = 0,
    $crj_totalDebit = 0,
    $gj_totalDebit = 0;

    public 
    $ckdj_totalCredit = 0,
    $cdj_totalCredit = 0,
    $crj_totalCredit = 0,
    $gj_totalCredit = 0;

    public function totalsCheckDisbursementJournal($ckdj_query){
        //@korinlv:added this function
        $check_disbursement_journals = $ckdj_query->with(['ckdj_sundry_data' => function ($query) {
        }])->get();
        
        $totalDebit = 0;
        $totalCredit = 0;

        foreach ($check_disbursement_journals as $journal) {
            foreach ($journal->ckdj_sundry_data ?: [] as $sundry) { // Ensure sundry data is treated as an array
                $totalDebit += $sundry->ckdj_debit ?? 0;
                $totalCredit += $sundry->ckdj_credit ?? 0;
            }
        }
    
        $this->ckdj_totalDebit = $totalDebit;
        $this->ckdj_totalCredit = $totalCredit;
    }

    public function totalsCashDisbursementJournal($cdj_query){
        //@korinlv:added this function
        $cash_disbursement_journals = $cdj_query->with(['cdj_sundry_data' => function($query){}])->get();
        
        $totalDebit = 0;
        $totalCredit = 0;

        foreach ($cash_disbursement_journals as $journal) {
            foreach ($journal->cdj_sundry_data ?: [] as $accountCode) { // Ensure sundry data is treated as an array
                $totalDebit += $accountCode->cdj_debit ?? 0;
                $totalCredit += $accountCode->cdj_credit ?? 0;
            }
        }

        $this->cdj_totalDebit = $totalDebit;
        $this->cdj_totalCredit = $totalCredit;
    }

    public function totalsCashReceiptJournal($crj_query){
        //@korinlv:added this function
        $cash_receipt_journals = $crj_query->with(['crj_sundry_data' => function($query){}])->get();
                
        $totalDebit = 0;
        $totalCredit = 0;
        
        foreach ($cash_receipt_journals as $journal) {
            foreach ($journal->crj_sundry_data ?: [] as $sundry) { // Ensure sundry data is treated as an array
                $totalDebit += $sundry->crj_debit ?? 0;
                $totalCredit += $sundry->crj_credit ?? 0;
            }
        }
            
        $this->crj_totalDebit = $totalDebit;
        $this->crj_totalCredit = $totalCredit;
    }

    public function totalsGeneralJournal($gj_query){
        //@korinlv:added this function
        $general_journals = $gj_query->with(['gj_accountcodes_data' => function($query){}])->get();
        
        $totalDebit = 0;
        $totalCredit = 0;

        foreach ($general_journals as $journal) {
            foreach ($journal->gj_accountcodes_data ?: [] as $accountCode) { 
                $totalDebit += $accountCode->gj_debit ?? 0;
                $totalCredit += $accountCode->gj_credit ?? 0;
            }
        }
    
        $this->gj_totalDebit = $totalDebit;
        $this->gj_totalCredit = $totalCredit;

    }

    public function render()
    {
        $ckdj_query = CheckDisbursementJournalModel::query();
        $cdj_query = CashDisbursementJournalModel::query(); 
        $crj_query = CashReceiptJournalModel::query(); 
        $gj_query = GeneralJournalModel::query();

        $this->totalsCheckDisbursementJournal($ckdj_query);
        $this->totalsCashDisbursementJournal($cdj_query);
        $this->totalsCashReceiptJournal($crj_query);
        $this->totalsGeneralJournal($gj_query);

        $check_disbursement_journals = $ckdj_query->with('ckdj_sundry_data')->get();
        $cash_disbursement_journals = $cdj_query->with('cdj_sundry_data')->get();
        $cash_receipt_journals = $crj_query->with('crj_sundry_data')->get();
        $general_journals = $gj_query->with('gj_accountcodes_data')->get();

        return view('livewire.charts', compact('check_disbursement_journals', 'cash_disbursement_journals', 'cash_receipt_journals', 'general_journals'));
    }
}
