<?php

namespace App\Exports;

use App\Models\LedgerSheetModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ledgerSheetExport implements FromCollection, WithHeadings
{
    protected $ls_accountname;

    public function __construct($ls_accountname)
    {
        $this->ls_accountname = $ls_accountname;
    }

    public function collection()
    {
        return LedgerSheetModel::select(
            "ls_date",
            "ls_vouchernum",
            "ls_particulars",
            "ls_balance_debit",
            "ls_debit",
            "ls_credit",
            "ls_credit_balance"
        )->where('ls_accountname', $this->ls_accountname)
        ->get();
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
            "Credits Balance"
        ];
    }
    
}
