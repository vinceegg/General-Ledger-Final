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
                'ckdj_account1'      => $row['account_1'],
                'ckdj_account2'      => $row['account_2'],
                'ckdj_account3'      => $row['account_3'],
                'ckdj_salary_wages'  => $row['sal_wages'],
                'ckdj_honoraria'     => $row['honoraria'],
            ]);

            if (isset($row['account_code'])) {
                $sundry = CKDJ_SundryModel::create([
                    'checkdisbursementjournal_no' => $journal->checkdisbursementjournal_no, // Ensure this is the correct key
                    'ckdj_accountcode' => $row['account_code'],
                    'ckdj_debit'       => $row['debit'],
                    'ckdj_credit'      => $row['credit'],
                ]);
            }
        }
    }

    public function map($row): array
    {
        return [
            'date'        => $row['ckdj_entrynum_date'],
            'check_no'    => $row['ckdj_checknum'],
            'payee'       => $row['ckdj_payee'],
            'bur'         => $row['ckdj_bur'],
            'cib_lcca'    => $row['ckdj_cib_lcca'],
            'account_1'   => $row['ckdj_account1'],
            'account_2'   => $row['ckdj_account2'],
            'account_3'   => $row['ckdj_account3'],
            'sal_wages'   => $row['ckdj_salary_wages'],
            'honoraria'   => $row['ckdj_honoraria'],
            'account_code'=> $row['ckdj_accountcode'],
            'debit'       => $row['ckdj_debit'],
            'credit'      => $row['ckdj_credit'],
        ];
    }

    public function rules(): array
    {
        return [
            '*.ckdj_entrynum_date' => 'required|date',
            '*.ckdj_checknum'      => 'required|string',
            '*.ckdj_payee'         => 'required|string',
            '*.ckdj_bur'           => 'required|integer',
            '*.ckdj_cib_lcca'      => 'nullable|numeric',
            '*.ckdj_account1'      => 'nullable|numeric',
            '*.ckdj_account2'      => 'nullable|numeric',
            '*.ckdj_account3'      => 'nullable|numeric',
            '*.ckdj_salary_wages'  => 'nullable|numeric',
            '*.ckdj_honoraria'     => 'nullable|numeric',
            '*.ckdj_accountcode'   => 'sometimes|required',
            '*.ckdj_debit'         => 'required_with:*.ckdj_accountcode|numeric',
            '*.ckdj_credit'        => 'required_with:*.ckdj_accountcode|numeric',
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