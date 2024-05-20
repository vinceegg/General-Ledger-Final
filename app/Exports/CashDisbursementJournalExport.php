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
        $cashDisbursements = CashDisbursementJournalModel::with('cdj_sundry_data')->get();
        $flattened = collect();

        foreach ($cashDisbursements as $cashDisbursement) {
            if ($cashDisbursement->cdj_sundry_data->isEmpty()) {
                // Add an empty record with cash disbursement data only if no sundry data
                $flattened->push([
                    'Date' => $cashDisbursement->cdj_entrynum_date,
                    'Reference/RD No.' => $cashDisbursement->cdj_referencenum,
                    'Accountable Officer' => $cashDisbursement->cdj_accountable_officer,
                    'JEV No.' => $cashDisbursement->cdj_jevnum,
                    'Credit Account Code' => $cashDisbursement->cdj_credit_accountcode,
                    'Amount' => $cashDisbursement->cdj_amount,
                    '5-02-99-990' => $cashDisbursement->cdj_account1,
                    '5-02-02-010' => $cashDisbursement->cdj_account2,
                    'Sundry Account Code' => '',
                    'PR' => '',
                    'Debit' => '',
                    'Credit' => '',
                ]);
            } else {
                foreach ($cashDisbursement->cdj_sundry_data as $sundryData) {
                    // Push each sundry data with cash disbursement data
                    $flattened->push([
                        'Date' => $cashDisbursement->cdj_entrynum_date,
                        'Reference/RD No.' => $cashDisbursement->cdj_referencenum,
                        'Accountable Officer' => $cashDisbursement->cdj_accountable_officer,
                        'JEV No.' => $cashDisbursement->cdj_jevnum,
                        'Credit Account Code' => $cashDisbursement->cdj_credit_accountcode,
                        'Amount' => $cashDisbursement->cdj_amount,
                        '5-02-99-990' => $cashDisbursement->cdj_account1,
                        '5-02-02-010' => $cashDisbursement->cdj_account2,
                        'Sundry Account Code' => $sundryData->cdj_sundry_accountcode,
                        'PR' => $sundryData->cdj_pr,
                        'Debit' => $sundryData->cdj_debit,
                        'Credit' => $sundryData->cdj_credit,
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
            "Account Code (Main)",
            "Amount",
            "5-02-99-990",
            "5-02-02-010",
            "Account Code (Sundry)",
            "PR",
            "Debit",
            "Credit",
        ];
    }

}