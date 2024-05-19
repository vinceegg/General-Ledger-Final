<?php

namespace App\Exports;

use App\Models\OvertimeandNightPayModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OvertimeandNightPayExport implements  FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OvertimeandNightPayModel::select(
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
            "Date",
            "Voucher No.",
            "Particulars",
            "Balance Debit",
            "Debits",
            "Credits",
            "Credits Balance"];
    }
}

