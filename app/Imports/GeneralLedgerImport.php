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
            'gl_date'               => $row['date'],
            'gl_vouchernum'         => $row['voucher_no'],
            'gl_particulars'        => $row['particulars'],
            'gl_balance_debit'      => $row['balance_debit'],
            'gl_debit'              => $row['debits'],
            'gl_credit'             => $row['credits'],
            'gl_credit_balance'     => $row['credits_balance']
        ]);

    }

    public function prepareForValidation($data, $index)
    {
        $keys = array_keys($data);
        $values = array_values($data);

        $keys = array_map(function ($key) {
            $key = str_replace(' ', '_', $key); // Replace spaces with underscores
            $key = str_replace('&', '_', $key); // Replace ampersand with underscore
            return strtolower($key);           // Convert to lowercase
        }, $keys);

        return array_combine($keys, $values);
    }

    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headers
    }

}