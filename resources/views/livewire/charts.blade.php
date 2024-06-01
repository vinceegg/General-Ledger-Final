<div>
    <!-- Check Disbursement Journal Table -->
    <h2>Check Disbursement Journal Totals</h2>
    <table>
        <tbody>
            @foreach($check_disbursement_journals as $journal)
                @foreach($journal->ckdj_sundry_data as $sundry)
                    <tr>
                        <td>{{ $sundry->ckdj_debit }}</td>
                        <td>{{ $sundry->ckdj_credit }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <!-- Cash Disbursement Journal Table -->
    <h2>Cash Disbursement Journal Totals</h2>
    <table>
        <tbody>
            @foreach($cash_disbursement_journals as $journal)
                @foreach($journal->cdj_sundry_data as $sundry)
                    <tr>
                        <td>{{ $sundry->cdj_debit }}</td>
                        <td>{{ $sundry->cdj_credit }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <!-- Cash Receipt Journal Table -->
    <h2>Cash Receipt Journal Totals</h2>
    <table>
        <tbody>
            @foreach($cash_receipt_journals as $journal)
                @foreach($journal->crj_sundry_data as $sundry)
                    <tr>
                        <td>{{ $sundry->crj_debit }}</td>
                        <td>{{ $sundry->crj_credit }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <!-- General Journal Table -->
    <h2>General Journal Totals</h2>
    <table>
        <tbody>
            @foreach($general_journals as $journal)
                @foreach($journal->gj_accountcodes_data as $accountCode)
                    <tr>
                        <td>{{ $accountCode->gj_debit }}</td>
                        <td>{{ $accountCode->gj_credit }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

