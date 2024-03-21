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
            'Date'=> $row['gj_entrynum_date'],
            'JEV No.'=> $row['gj_jevnum'],
            'Particulars'=> $row['gj_particulars'],
            'Accountcode'=> $row['gj_accountcode'],
            'Debit'=> $row['gj_debit'],
            'Credit'=> $row['gj_credit'],
            
        ]);
    }
}