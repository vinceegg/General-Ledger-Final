<?php

namespace App\Imports;

use App\Models\CashDisbursementJournalModel;
use Maatwebsite\Excel\Concerns\ToModel;

class CashDisbursementJournalImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CashDisbursementJournalModel([
            'cdj_entrynum'=> $row['cdj_entrynum'],
            'cdj_entrynum_date'=> $row['cdj_entrynum_date'],
            'cdj_referencenum'=> $row['cdj_referencenum'],
            'cdj_accountable_officer'=> $row['cdj_accountable_officer'],
            'cdj_jevnum'=> $row['cdj_jevnum'],
            'cdj_accountcode'=> $row['cdj_accountcode'],
            'cdj_amount'=> $row['cdj_amount'],
            'cdj_account1'=> $row['cdj_account1'],
            'cdj_account2'=> $row['cdj_account2'],
            'cdj_sundry_accountcode'=> $row['cdj_sundry_accountcode'],
            'cdj_pr'=> $row['cdj_pr'],
            'cdj_debit'=> $row['cdj_debit'],
            'cdj_credit'=> $row['cdj_credit']
        ]);
    }
}