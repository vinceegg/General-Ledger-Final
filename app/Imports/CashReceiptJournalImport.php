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
            'Date' => $row['crj_entrynum_date'],
            'JEV No.' => $row['crj_jevnum'],
            'Payee' => $row['crj_payor'],
            'Collection Debit' => $row['crj_collection_debit'],
            'Collection Credit'=> $row['crj_collection_credit'],
            'Deposit Debit'=> $row['crj_deposit_debit'],
            'Deposit Credit'=> $row['crj_deposit_credit'],
            'Account Code'=> $row['crj_accountcode'],
            'Debit'=> $row['crj_debit'],
            'Credit'=> $row['crj_credit']

        ]);
    }
}