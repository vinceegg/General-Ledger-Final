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
            'Reference/RD No.'=> $row['cdj_referencenum'],
            'Accountable Officer'=> $row['cdj_accountable_officer'],
            'JEV No.'=> $row['cdj_jevnum'],
            'Account Code'=> $row['cdj_accountcode'],
            'Amount'=> $row['cdj_amount'],
            '5-02-99-990'=> $row['cdj_account1'],
            '5-02-02-010'=> $row['cdj_account2'],
            'Account Code'=> $row['cdj_sundry_accountcode'],
            'PR'=> $row['cdj_pr'],
            'Debit'=> $row['cdj_debit'],
            'Credit'=> $row['cdj_credit']
        ]);
    }
}