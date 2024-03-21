<?php

namespace App\Exports;

use App\Models\CashDisbursementJournalModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CashDisbursementJournalExport implements FromCollection, WithHeadings
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CashDisbursementJournalModel::select(
        "cdj_entrynum_date",
        "cdj_referencenum",
        "cdj_accountable_officer",
        "cdj_jevnum",
        "cdj_accountcode",
        "cdj_amount",
        "cdj_account1",
        "cdj_account2",
        "cdj_sundry_accountcode",
        "cdj_pr",
        "cdj_debit",
        "cdj_credit" )->get();
    }

    public function headings(): array
    {
    
        return [
            "Date",
            "Reference/RD No.",
            "Accountable Officer",
            "JEV No.",
            "Account Code",
            "Amount",
            "5-02-99-990",
            "5-02-02-010",
           "Account Code",
            "PR",
            "Debit",
            "Credit" ];
        }
}