<?php

namespace App\Exports;

use App\Models\GeneralLedgerModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GeneralLedgerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GeneralLedgerModel::select(
        "gl_symbol",
        "gl_fundname",
        "gl_func_classification",
        "gl_project_title",
        "gl_date",
        "gl_vouchernum",
        "gl_particulars",
        "gl_balance_debit",
        "gl_debit",
        'gl_credit',
        "gl_credit_balance", )->get();
    }

    public function headings(): array
    {
        return [
            "Symbol",
            "Name of Fund or Account",
            "Functional Classification",
            "Title of Project or Expense Classification",
            "Date",
            "Voucher No.",
            "Particulars",
            "Balance Debit",
            "Debits",
            "Credits",
            "Credits Balance"];
    }
}