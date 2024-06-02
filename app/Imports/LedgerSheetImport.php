<?php

namespace App\Imports;

use App\Models\LedgerSheetModel;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class LedgerSheetImport implements WithCalculatedFormulas, WithChunkReading, ToArray, WithHeadingRow
{
    use Importable;

    public function array(array $rows): array
    {
        foreach ($rows as $row) {
            // Prepare the row data
            $row = $this->prepareForValidation($row);

            // Create and save the model
            LedgerSheetModel::create([
                'ls_date'            => $row['date'],
                'ls_accountname'     => $row['account_name'],
                'ls_vouchernum'      => $row['voucher_no'],
                'ls_particulars'     => $row['particulars'],
                'ls_balance_debit'   => $row['balance_debit'],
                'ls_debit'           => $row['debits'],
                'ls_credit'          => $row['credits'],
                'ls_credit_balance'  => $row['credits_balance']
            ]);
        }

        return $rows;
    }

    public function prepareForValidation($row)
    {
        $keys = array_keys($row);
        $values = array_values($row);

        $keys = array_map(function ($key) {
            $key = str_replace(' ', '_', $key); // Replace spaces with underscores
            $key = str_replace('&', '_', $key); // Replace ampersand with underscore
            return strtolower($key);           // Convert to lowercase
        }, $keys);

        return array_combine($keys, $values);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headers
    }
}
