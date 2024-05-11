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
            $journal = CashDisbursementJournalModel::create([
                'cdj_entrynum_date' => $row['date'],
                'cdj_referencenum' => $row['reference_num'],
                'cdj_accountable_officer' => $row['accountable_officer'],
                'cdj_jevnum' => $row['jev_no'],
                'cdj_accountcode' => $row['account_code'],
                'cdj_amount' => $row['amount'],
                'cdj_account1' => $row['account1'],
                'cdj_account2' => $row['account2'],
                // Add more fields as needed
            ]);

            if (isset($row['cdj_sundry_data'])) {
                foreach ($row['cdj_sundry_data'] as $sundry) {
                    $sundryModel = $journal->cdj_sundry_data()->create([
                        'cdj_sundry_accountcode' => $sundry['account_code'],
                        'cdj_pr' => $sundry['pr'],
                        'cdj_debit' => $sundry['debit'],
                        'cdj_credit' => $sundry['credit'],
                    ]);
                }
            }
        }
    }

    public function map($row): array
    {
        return [
            'date' => $row['Date'],
            'reference_num' => $row['Reference/RD No.'],
            'accountable_officer' => $row['Accountable Officer'],
            'jev_num' => $row['JEV No.'],
            'account_code' => $row['Account Code (Main)'],
            'amount' => $row['Amount'],
            'account1' => $row['5-02-99-990'],
            'account2' => $row['5-02-02-010'],
            'cdj_sundry_data' => [
                [
                    'account_code' => $row['Account Code (Sundry)'],
                    'pr' => $row['PR'],
                    'debit' => $row['Debit'],
                    'credit' => $row['Credit'],
                ]
            ],
        ];
    }

    public function rules(): array
    {
        return [
            '*.Date' => 'required|date',
            '*.Reference/RD No.' => 'required|string',
            '*.Accountable Officer' => 'required|string',
            '*.JEV No.' => 'required|integer',
            '*.Account Code (Main)' => 'required|integer',
            '*.Amount' => 'required|numeric',
            '*.5-02-99-990' => 'nullable|numeric',
            '*.5-02-02-010' => 'nullable|numeric',
            '*.Account Code (Sundry)' => 'sometimes|required',
            '*.PR' => 'required_with:Account Code (Sundry)|string',
            '*.Debit' => 'required_with:Account Code (Sundry)|numeric',
            '*.Credit' => 'required_with:Account Code (Sundry)|numeric',
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