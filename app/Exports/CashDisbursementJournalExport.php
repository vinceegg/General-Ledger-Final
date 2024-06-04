<?php

namespace App\Exports;

use App\Models\CashDisbursementJournalModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CashDisbursementJournalExport implements FromCollection, WithHeadings
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $journals = CashDisbursementJournalModel::with('cdj_sundry_data')->get();
        $flattened = collect();

        foreach ($journals as $journal) {
            if ($journal->cdj_sundry_data->isEmpty()) {
                // Add an empty record with journal data only if no sundry data
                $flattened->push([
                    'Date' => $journal->cdj_entrynum_date,
                    'Reference No.' => $journal->cdj_referencenum,
                    'Accountable Officer' => $journal->cdj_accountable_officer,
                    'JEV No.' => $journal->cdj_jevnum,
                    'Account Code' => $journal->cdj_credit_accountcode,
                    'Amount' => $journal->cdj_amount,
                    'Account1' => $journal->cdj_account1,
                    'Account2' => $journal->cdj_account2,
                    'Sundry Account Code' => '',
                    'PR' => $journal->cdj_pr,
                    'Debit' => $journal->cdj_debit,
                    'Credit' => $journal->cdj_credit,
                ]);
            } else {
                foreach ($journal->cdj_sundry_data as $sundry) {
                    // Push each sundry data with journal data
                    $flattened->push([
                        'Date' => $journal->cdj_entrynum_date,
                        'Reference No.' => $journal->cdj_referencenum,
                        'Accountable Officer' => $journal->cdj_accountable_officer,
                        'JEV No.' => $journal->cdj_jevnum,
                        'Account Code' => $journal->cdj_credit_accountcode,
                        'Amount' => $journal->cdj_amount,
                        'Account1' => $journal->cdj_account1,
                        'Account2' => $journal->cdj_account2,
                        'Sundry Account Code' => $sundry->cdj_sundry_accountcode,
                        'PR' => $journal->cdj_pr,
                        'Debit' => $sundry->cdj_debit,
                        'Credit' => $sundry->cdj_credit,
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
            "Reference/RD No.",
            "Accountable Officer",
            "JEV No.",
            "Account Code",
            "Amount",
            "5-02-99-990",
            "5-02-02-010",
            "Sundry Account Code",
            "PR",
            "Debit",
            "Credit",
        ];
    }
}