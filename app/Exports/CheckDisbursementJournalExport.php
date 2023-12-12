<?php

namespace App\Exports;

use App\Models\CheckDisbursementJournalModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CheckDisbursementJournalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CheckDisbursementJournalModel::select("ckdj_entrynum", "ckdj_entrynum_date", "ckdj_checknum",
        "ckdj_payee", "ckdj_bur", "ckdj_cib_lcca", "ckdj_account1",
         "ckdj_account2", "ckdj_account3", "ckdj_salary_wages","ckdj_honoraria",
          "ckdj_sundry_accountcode", "ckdj_debit", "ckdj_credit" )->get();
    }
    
    public function headings(): array
    {
        return [
        "Entry Number",
        "Date",
        "JEV No.",
        "Payor",
        "Collection Debit",
        "Collection Credit",
        "Deposit Debit",
        "Deposit Credit",
        "Account Code",
        "Debit",
        "Credit"];
    }
    

}