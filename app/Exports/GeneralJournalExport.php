<?php

namespace App\Exports;

use App\Models\GeneralJournalModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GeneralJournalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GeneralJournalModel::all();
    }

        /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["entrynumber", "date", "jevnumber", "particulars", "accountcode", "debit", "credit", "Journalcol"];
    }
}