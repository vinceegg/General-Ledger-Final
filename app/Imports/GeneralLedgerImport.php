<?php

namespace App\Imports;

use App\Models\GeneralLedgerModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GeneralLedgerImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GeneralLedgerModel([
            'gl_symbol'             => $row['symbol'], // Make sure these match the heading names exactly as in the export
            'gl_fundname'           => $row['name of fund or account'],
            'gl_func_classification' => $row['functional classification'],
            'gl_project_title'      => $row['title of project or expense classification'],
            'gl_date'               => $row['date'],
            'gl_vouchernum'         => $row['voucher no.'],
            'gl_particulars'        => $row['particulars'],
            'gl_balance_debit'      => $row['balance debit'],
            'gl_debit'              => $row['debits'],
            'gl_credit'             => $row['credits'],
            'gl_credit_balance'     => $row['credits balance']
        ]);
    }

}