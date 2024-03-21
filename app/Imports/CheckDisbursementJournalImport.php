<?php

namespace App\Imports;

use App\Models\CheckDisbursementJournalModel;
use Maatwebsite\Excel\Concerns\ToModel;

class CheckDisbursementJournalImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CheckDisbursementJournalModel([
            'Date'=> $row['ckdj_entrynum_date'],
            'Check No.'=> $row['ckdj_checknum'],
            'Payee'=> $row['ckdj_payee'],
            'BUR'=> $row['ckdj_bur'],
            'CIB-LCCA'=> $row['ckdj_cib_lcca'],
            '2-02-01-010-A'=> $row['ckdj_account1'],
            '2-02-01-010-B'=> $row['ckdj_account2'],
            '2-02-01-010-B'=> $row['ckdj_account3'],
            'Sal&Wages'=> $row['ckdj_salary_wages'],
            'Honoraria'=> $row['ckdj_honoraria'],
            'Account Code'=> $row['ckdj_sundry_accountcode'],
            'Debit'=> $row['ckdj_debit'],
            'Credit'=> $row['ckdj_credit']
        ]);
    }
}