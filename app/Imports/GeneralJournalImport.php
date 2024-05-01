<?php

namespace App\Imports;

use App\Models\GeneralJournalModel;
use Maatwebsite\Excel\Concerns\ToModel;

class GeneralJournalImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GeneralJournalModel([
            'gj_entrynum_date'=> $row['gj_entrynum_date'],
            'gj_jevnum'=> $row['gj_jevnum'],
            'gj_particulars'=> $row['gj_particulars'],
            'gj_accountcode'=> $row['gj_accountcode'],
            'gj_debit'=> $row['gj_debit'],
            'gj_credit'=> $row['gj_credit'],
            
        ]);
    }
}