<?php

namespace App\Imports;

use App\Models\CashReceiptJournalModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CashReceiptJournalImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CashReceiptJournalModel([
            'crj_entrynum' => $row['crj_entrynum'],
            'crj_entrynum_date' => $row['crj_entrynum_date'],
            'crj_jevnum' => $row['crj_jevnum'],
            'crj_payor' => $row['crj_payor'],
            'crj_collection_debit' => $row['crj_collection_debit'],
            'crj_collection_credit'=> $row['crj_collection_credit'],
            'crj_deposit_debit'=> $row['crj_deposit_debit'],
            'crj_deposit_credit'=> $row['crj_deposit_credit'],
            'crj_accountcode'=> $row['crj_accountcode'],
            'crj_debit'=> $row['crj_debit'],
            'crj_credit'=> $row['crj_credit']

        ]);
    }
}