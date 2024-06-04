<?php

namespace App\Imports;

use App\Models\CashDisbursementJournalModel;
use App\Models\CDJ_SundryModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Illuminate\Support\Facades\DB;

class CashDisbursementJournalImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Create the journal entry
            $journal = CashDisbursementJournalModel::create([
                'cdj_entrynum_date' => $row['date'],
                'cdj_referencenum' => $row['reference_num'],
                'cdj_accountable_officer' => $row['accountable_officer'],
                'cdj_jevnum' => $row['jev_no'],
                'cdj_credit_accountcode' => $row['credit_account_code'],
                'cdj_amount' => $row['amount'],
                'cdj_account1' => $row['account1'],
                'cdj_account2' => $row['account2'],
            ]);

            // Check if sundry data is present and create associated entries
            if (!empty($row['sundry_account_code']) || !empty($row['pr']) || !empty($row['debit']) || !empty($row['credit'])) {
                CDJ_SundryModel::create([
                    'cashdisbursementjournal_no' => $journal->cashdisbursementjournal_no, // Foreign key to the journal entry
                    'cdj_sundry_accountcode' => $row['sundry_account_code'],
                    'cdj_pr' => $row['pr'],
                    'cdj_debit' => $row['debit'],
                    'cdj_credit' => $row['credit'],
                ]);
            }
        }
    }

    public function map($row): array
    {
        return [
            'cdj_date' => $row['date'],
            'cdj_reference_num' => $row['reference_num'],
            'cdj_accountable_officer' => $row['accountable_officer'],
            'cdj_jev_num' => $row['jev_num'],
            'cdj_credit_accountcode' => $row['credit_account_code'],
            'cdj_amount' => $row['amount'],
            'cdj_account1' => $row['account1'],
            'cdj_account2' => $row['account2'],
            'cdj_sundry_data' => [
                [
                    'cdj_sundry_accountcode' => $row['sundry_account_code'],
                    'cdj_pr' => $row['pr'],
                    'cdj_debit' => $row['debit'],
                    'cdj_credit' => $row['credit'],
                ]
            ],
        ];
    }

    public function rules(): array
    {
        return [
            '*.date' => 'required|date',
            '*.reference_num' => 'required|string',
            '*.accountable_officer' => 'required|string',
            '*.jev_no' => 'required|integer',
            '*.credit_account_code' => 'required|string',
            '*.amount' => 'required|numeric',
            '*.account1' => 'required|integer',
            '*.account2' => 'required|integer',
            '*.sundry_account_code' => 'nullable|string',
            '*.pr' => 'nullable|string',
            '*.debit' => 'nullable|numeric',
            '*.credit' => 'nullable|numeric',
        ];
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