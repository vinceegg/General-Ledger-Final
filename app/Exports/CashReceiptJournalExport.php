<?php

namespace App\Exports;

use App\Models\CashReceiptJournalModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CashReceiptJournalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $journals = CashReceiptJournalModel::with('crj_sundry_data')->get();
        $flattened = collect();

        foreach ($journals as $journal) {
            if ($journal->crj_sundry_data->isEmpty()) {
                // Add an empty record with journal data only if no sundry data
                $flattened->push([
                    'Date' => $journal->crj_entrynum_date,
                    'JEV No.' => $journal->crj_jevnum,
                    'Payor' => $journal->crj_payor,
                    'Collection Debit' => $journal->crj_collection_debit,
                    'Collection Credit' => $journal->crj_collection_credit,
                    'Deposit Debit' => $journal->crj_deposit_debit,
                    'Deposit Credit' => $journal->crj_deposit_credit,
                    'Account Code' => $journal->crj_accountcode,
                    'Debit' => $journal->crj_debit,
                    'Credit' => $journal->crj_credit,
                ]);
            } else {
                foreach ($journal->crj_sundry_data as $sundry) {
                    // Push each sundry data with journal data
                    $flattened->push([
                        'Date' => $journal->crj_entrynum_date,
                        'JEV No.' => $journal->crj_jevnum,
                        'Payor' => $journal->crj_payor,
                        'Collection Debit' => $journal->crj_collection_debit,
                        'Collection Credit' => $journal->crj_collection_credit,
                        'Deposit Debit' => $journal->crj_deposit_debit,
                        'Deposit Credit' => $journal->crj_deposit_credit,
                        'Account Code' => $sundry->crj_accountcode,
                        'Debit' => $sundry->crj_debit,
                        'Credit' => $sundry->crj_credit,
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
            "JEV No.",
            "Payor",
            "Collection Debit",
            "Collection Credit",
            "Deposit Debit",
            "Deposit Credit",
            "Account Code",
            "Debit",
            "Credit",
        ];
    }

}