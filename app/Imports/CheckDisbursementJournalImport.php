<?php

namespace App\Imports;

use App\Models\CheckDisbursementJournalModel;
use App\Models\CKDJ_SundryModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Illuminate\Support\Facades\DB;

class CheckDisbursementJournalImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $journal = CheckDisbursementJournalModel::create([
                'ckdj_entrynum_date' => $row['date'],
                'ckdj_checknum'      => $row['check_no'],
                'ckdj_payee'         => $row['payee'],
                'ckdj_bur'           => $row['bur'],
                'ckdj_cib_lcca'      => $row['cib_lcca'],
                'ckdj_account1'      => $row['account1'],
                'ckdj_account2'      => $row['account2'],
                'ckdj_account3'      => $row['account3'],
                'ckdj_salary_wages'  => $row['sal_wages'],
                'ckdj_honoraria'     => $row['honoraria'],
            ]);

            if (isset($row['account_code'])) {
                $sundry = CKDJ_SundryModel::create([
                    'check_disbursement_journal_id' => $journal->id, // Set the foreign key
                    'ckdj_accountcode' => $row['account_code'],
                    'ckdj_debit'        => $row['debit'],
                    'ckdj_credit'       => $row['credit'],
                ]);
            }
        }
    }




    public function map($row): array
    {
        return [
            'ckdj_entrynum_date' => $row['date'],
                'ckdj_checknum' => $row['check_no'],
                'ckdj_payee' => $row['payee'],
                'ckdj_bur' => $row['bur'],
                'ckdj_cib_lcca' => $row['cib_lcca'],
                'ckdj_account1' => $row['account1'],
                'ckdj_account2' => $row['account2'],
                'ckdj_account3' => $row['account3'],
                'ckdj_salary_wages' => $row['sal_wages'],
                'ckdj_honoraria' => $row['honoraria'],
        ];
    }

    public function rules(): array
    {
        return [
            '*.date' => 'required|date',
            '*.check_no' => 'required|string',
            '*.payee' => 'required|string',
            '*.bur' => 'required|integer',
            '*.cib_lcca' => 'nullable|numeric',
            '*.account1' => 'nullable|numeric',
            '*.account2' => 'nullable|numeric',
            '*.account3' => 'nullable|numeric',
            '*.sal_wages' => 'nullable|numeric',
            '*.honoraria' => 'nullable|numeric',
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