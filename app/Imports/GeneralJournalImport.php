<?php

namespace App\Imports;

use App\Models\GeneralJournalModel;
use App\Models\GeneralJournal_AccountCodesModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class GeneralJournalImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $journal = GeneralJournalModel::create([
                'gj_entrynum_date' => $row['date'],
                'gj_jevnum'        => $row['jev_no'],
                'gj_particulars'   => $row['particulars'],
            ]);

            if (isset($row['account_code'])) {
                GeneralJournal_AccountCodesModel::create([
                    'general_journal_id' => $journal->id,
                    'gj_accountcode' => $row['account_code'],
                    'gj_debit'        => $row['debit'],
                    'gj_credit'       => $row['credit'],
                ]);
            }
        }
    }

    public function map($row): array
    {
        return [
            'date' => $row['date'],
            'jev_no' => $row['jev_no'],
            'particulars' => $row['particulars'],
        ];
    }

    public function rules(): array
    {
        return [
            '*.date' => 'required|date',
            '*.jev_no' => 'required|string',
            '*.particulars' => 'required|string',
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
            return strtolower(str_replace(' ', '_', $key)); // Replace spaces with underscores and convert to lowercase
        }, $keys);

        return array_combine($keys, $values);
    }

    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headers
    }
}