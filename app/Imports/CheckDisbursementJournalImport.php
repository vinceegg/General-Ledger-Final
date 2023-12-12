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
            'ckdj_entrynum'=> $row['ckdj_entrynum'],
            'ckdj_entrynum_date'=> $row['ckdj_entrynum_date'],
            'ckdj_checknum'=> $row['ckdj_checknum'],
            'ckdj_payee'=> $row['ckdj_payee'],
            'ckdj_bur'=> $row['ckdj_bur'],
            'ckdj_cib_lcca'=> $row['ckdj_cib_lcca'],
            'ckdj_account1'=> $row['ckdj_account1'],
            'ckdj_account2'=> $row['ckdj_account2'],
            'ckdj_account3'=> $row['ckdj_account3'],
            'ckdj_salary_wages'=> $row['ckdj_salary_wages'],
            'ckdj_honoraria'=> $row['ckdj_honoraria'],
            'ckdj_sundry_accountcode'=> $row['ckdj_sundry_accountcode'],
            'ckdj_debit'=> $row['ckdj_debit'],
            'ckdj_credit'=> $row['ckdj_credit']
        ]);
    }
}