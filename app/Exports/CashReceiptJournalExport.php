<?php

namespace App\Exports;

use App\Models\CashReceiptJournalModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CashReceiptJournalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
{
    return CashReceiptJournalModel::select(
        "crj_entrynum_date",
        "crj_jevnum",
        "crj_payor",
        "crj_collection_debit",
        "crj_collection_credit",
        "crj_deposit_debit",
        "crj_deposit_credit",
        "crj_accountcode",
        "crj_debit",
        "crj_credit")->get(); // Execute the query and retrieve the data
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
            "Payee",
            "Collection Debit",
            "Collection Credit",
            "Deposit Debit",
            "Deposit Credit",
            "Account Code",
            "Debit",
            "Credit" ];

    }

}