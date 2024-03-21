<?php

namespace App\Imports;

use App\Models\GeneralLedgerModel;
use Maatwebsite\Excel\Concerns\ToModel;

class GeneralLedgerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GeneralLedgerModel([
            'Symbol'=> $row['gl_symbol'],
            'Name of Fund or Account'=>$row['gl_fundname'],
            'Functional Classification'=>$row['gl_func_classification'],
            'Title of Project or Expense Classification'=>$row['gl_project_title'],
            'Date'=>$row['gl_date'],
            'Voucher No.'=>$row['gl_vouchernum'],
            'Particulars'=>$row['gl_particulars'],
            'Balance Debit'=>$row['gl_balance_debit'],
            'Debits'=>$row['gl_debit'],
            'Credits'=>$row['gl_credit'],
            'Credits Balance'=>$row['gl_credit_balance']
        ]);
    }
}