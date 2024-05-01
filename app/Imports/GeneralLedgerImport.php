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
            'gl_symbol' => $row['gl_symbol'],
            'gl_fundname' => $row['gl_fundname'],
            'gl_func_classification' => $row['gl_func_classification'],
            'gl_project_title' => $row['gl_project_title'],
            'gl_date' => $row['gl_date'],
            'gl_vouchernum' => $row['gl_vouchernum'],
            'gl_particulars' => $row['gl_particulars'],
            'gl_balance_debit' => $row['gl_balance_debit'],
            'gl_debit' => $row['gl_debit'],
            'gl_credit' => $row['gl_credit'],
            'gl_credit_balance' => $row['gl_credit_balance']
        ]);
    }

}