<?php

namespace App\Exports;

use App\Models\CheckDisbursementJournalModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CheckDisbursementJournalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
{
    $journals = CheckDisbursementJournalModel::with('ckdj_sundry_data')->get();
    $flattened = collect();

    foreach ($journals as $journal) {
        if ($journal->ckdj_sundry_data->isEmpty()) {
            // Add an empty record with journal data only if no sundry data
            $flattened->push([
                'Date' => $journal->ckdj_entrynum_date,
                'Check No.' => $journal->ckdj_checknum,
                'Payee' => $journal->ckdj_payee,
                'BUR' => $journal->ckdj_bur,
                'CIB-LCCA' => $journal->ckdj_cib_lcca,
                'Account1' => $journal->ckdj_account1,
                'Account2' => $journal->ckdj_account2,
                'Account3' => $journal->ckdj_account3,
                'Salaries and Wages' => $journal->ckdj_salary_wages,
                'Honoraria' => $journal->ckdj_honoraria,
                'Account Code' => '',
                'Debit' => '',
                'Credit' => '',
            ]);
        } else {
            foreach ($journal->ckdj_sundry_data as $sundry) {
                // Push each sundry data with journal data
                $flattened->push([
                    'Date' => $journal->ckdj_entrynum_date,
                    'Check No.' => $journal->ckdj_checknum,
                    'Payee' => $journal->ckdj_payee,
                    'BUR' => $journal->ckdj_bur,
                    'CIB-LCCA' => $journal->ckdj_cib_lcca,
                    'Account1' => $journal->ckdj_account1,
                    'Account2' => $journal->ckdj_account2,
                    'Account3' => $journal->ckdj_account3,
                    'Salaries and Wages' => $journal->ckdj_salary_wages,
                    'Honoraria' => $journal->ckdj_honoraria,
                    'Account Code' => $sundry->ckdj_accountcode,
                    'Debit' => $sundry->ckdj_debit,
                    'Credit' => $sundry->ckdj_credit,
                ]);
            }
        }
    }

    return $flattened;
}

    
    public function headings(): array
    {
        return [
            "Date",
            "Check No.",
            "Payee",
            "BUR",
            "CIB-LCCA",
            "2-02-01-010-A",
            "2-02-01-010-B",
            "2-02-01-010-E",
            "Sal&Wages",
            "Honoraria",
            "Account Code",
            "Debit",
            "Credit"];
    }
    

}