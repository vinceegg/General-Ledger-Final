<?php

namespace App\Exports;

use App\Models\CashReceiptJournalModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CashReceiptJournalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CashReceiptJournalModel::all();
    }

}