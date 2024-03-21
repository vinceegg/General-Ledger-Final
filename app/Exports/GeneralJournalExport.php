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
        return GeneralJournalModel::select(
            "gj_entrynum",
            "gj_entrynum_date",
            "gj_jevnum",
            "gj_particulars",
            "gj_accountcode",
            "gj_debit",
            "gj_credit")->get();
    }

        /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            "Date",
            "JEV No.",
            "Particulars",
            "Accountcode",
            "Debit",
            "Credit"];
    }
}