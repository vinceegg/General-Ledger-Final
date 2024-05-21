<?php

namespace App\Imports;

use App\Models\CashReceiptJournalModel;
use App\Models\CRJ_SundryModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class CashReceiptJournalImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $journal = CashReceiptJournalModel::create([
                'crj_entrynum_date'     => $row['date'],
                'crj_jevnum'            => $row['jev_no'],
                'crj_payor'             => $row['payor'],
                'crj_collection_debit'  => $row['collection_debit'],
                'crj_collection_credit' => $row['collection_credit'],
                'crj_deposit_debit'     => $row['deposit_debit'],
                'crj_deposit_credit'    => $row['deposit_credit'],
            ]);

            if (isset($row['account_code'])) {
                CRJ_SundryModel::create([
                    'cash_receipt_journal_id' => $journal->id,
                    'crj_accountcode' => $row['account_code'],
                    'crj_debit'        => $row['debit'],
                    'crj_credit'       => $row['credit'],
                ]);
            }
        }
    }

    public function map($row): array
    {
        return [
            'crj_entrynum_date' => $row['date'],
            'crj_jevnum' => $row['jev_no'],
            'crj_payor' => $row['payor'],
            'crj_collection_debit' => $row['collection_debit'],
            'crj_collection_credit' => $row['collection_credit'],
            'crj_deposit_debit' => $row['deposit_debit'],
            'crj_deposit_credit' => $row['deposit_credit'],
        ];
    }

    public function rules(): array
    {
        return [
            '*.date' => 'required|date',
            '*.jev_no' => 'required|string',
            '*.payor' => 'required|string',
            '*.collection_debit' => 'nullable|numeric',
            '*.collection_credit' => 'nullable|numeric',
            '*.deposit_debit' => 'nullable|numeric',
            '*.deposit_credit' => 'nullable|numeric',
            '*.account_code' => 'sometimes|required',
            '*.debit' => 'required_with:account_code|numeric',
            '*.credit' => 'required_with:account_code|numeric',
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