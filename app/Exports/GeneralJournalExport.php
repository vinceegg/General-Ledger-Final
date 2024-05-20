<?php

namespace App\Exports;

use App\Models\GeneralJournalModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GeneralJournalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $journals = GeneralJournalModel::with('gj_accountcodes_data')->get();
        $flattened = collect();

        foreach ($journals as $journal) {
            if ($journal->gj_accountcodes_data->isEmpty()) {
                // Add an empty record with journal data only if no account code data
                $flattened->push([
                    'Date' => $journal->gj_entrynum_date,
                    'JEV No.' => $journal->gj_jevnum,
                    'Particulars' => $journal->gj_particulars,
                    'Accountcode' => '',
                    'Debit' => '',
                    'Credit' => '',
                ]);
            } else {
                foreach ($journal->gj_accountcodes_data as $accountCode) {
                    // Push each account code data with journal data
                    $flattened->push([
                        'Date' => $journal->gj_entrynum_date,
                        'JEV No.' => $journal->gj_jevnum,
                        'Particulars' => $journal->gj_particulars,
                        'Accountcode' => $accountCode->gj_accountcode,
                        'Debit' => $accountCode->gj_debit,
                        'Credit' => $accountCode->gj_credit,
                    ]);
                }
            }
        }

            return $flattened;
    }

        /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            "Date",
            "JEV No.",
            "Particulars",
            "Accountcode",
            "Debit",
            "Credit",
            ];
    }
}