<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;
use App\Models\ledgerSheetModel;
use App\Models\CashDisbursementJournalModel;
use App\Models\CashReceiptJournalModel;
use App\Models\CheckDisbursementJournalModel;
use App\Models\GeneralJournalModel;

Route::get('/', function () {
    $lsDebit = ledgerSheetModel::all();

    $total_debit = 0;
    foreach($lsDebit as $num){
        $total_debit += $num->ls_debit;
    }

    return view('dashboard',compact('test', 'total_debit'));
});

Route::get('/dashboard', function () {
    // ckdj total debit
    $ckdjTotalDebit = CheckDisbursementJournalModel::all();

    $ckdj_total_debit = 0;
    foreach($ckdjTotalDebit as $num){
        $ckdj_total_debit += $num->ckdj_debit;
    }

    // ckdj total credit
    $ckdjTotalcredit = CheckDisbursementJournalModel::all();

    $ckdj_total_credit = 0;
    foreach($ckdjTotalcredit as $num){
        $ckdj_total_credit += $num->ckdj_credit;
    }

    // cdj total debit
    $cdjTotalDebit = CashDisbursementJournalModel::all();

    $cdj_total_debit = 0;
    foreach($cdjTotalDebit as $num){
        $cdj_total_debit += $num->cdj_debit;
    }

    // cdj total credit
    $cdjTotalcredit = CashDisbursementJournalModel::all();

    $cdj_total_credit = 0;
    foreach($cdjTotalcredit as $num){
        $cdj_total_credit += $num->cdj_credit;
    }

    // crj TOTAL DEBIT
    $crjTotalDebit = CashReceiptJournalModel::all();

    $crj_total_debit = 0;
    foreach($crjTotalDebit as $num){
        $crj_total_debit += $num->crj_debit;
    }

    // crj TOTAL credit
    $crjTotalcredit = CashReceiptJournalModel::all();

    $crj_total_credit = 0;
    foreach($crjTotalcredit as $num){
        $crj_total_credit += $num->crj_credit;
    }

    // gj TOTAL DEBIT
    $gjTotalDebit = GeneralJournalModel::all();

    $gj_total_debit = 0;
    foreach($gjTotalDebit as $num){
        $gj_total_debit += $num->gj_debit;
    }

    // gj TOTAL credit
    $gjTotalcredit = GeneralJournalModel::all();

    $gj_total_credit = 0;
    foreach($gjTotalcredit as $num){
        $gj_total_credit += $num->gj_credit;
    }
    
    // LS TOTAL debit
    $lsTotaldebit = ledgerSheetModel::all();

    $ls_total_debit = 0;
    foreach($lsTotaldebit as $num){
        $ls_total_debit += $num->ls_debit;
    }

    // LS TOTAL credit
    $lsTotalCredit = ledgerSheetModel::all();

    $ls_total_credit = 0;
    foreach($lsTotalCredit as $num){
        $ls_total_credit += $num->ls_credit;
    }

    return view('dashboard',compact(
    'ckdj_total_debit','cdj_total_debit','crj_total_debit','gj_total_debit',
    'ckdj_total_credit','cdj_total_credit','crj_total_credit','gj_total_credit',
    'ls_total_debit','ls_total_credit'
));
});



//Routes for each table of journals
Route::get('/CRJ', [App\Http\Controllers\CashReceiptJournalController::class, 'index'])->name('CRJ');
Route::get('/CKDJ', [App\Http\Controllers\CheckDisbursementJournalController::class, 'index'])->name('CKDJ');
Route::get('/CDJ', [App\Http\Controllers\CashDisbursementJournalController::class, 'index'])->name('CDJ');
Route::get('/GJ', [App\Http\Controllers\GeneralJournalController::class, 'index'])->name('GJ');



//ROUTES FOR ARCHIVED RECORDS
Route::get('/CashDisbursementJournalArchived', [App\Http\Controllers\CashDisbursementJournalTrash::class, 'index'])->name('CashDisbursementJournalArchived');
Route::get('/CheckDisbursementJournalArchived', [App\Http\Controllers\CheckDisbursementJournalTrash::class, 'index'])->name('CheckDisbursementJournalArchived');
Route::get('/CashReceiptJournalArchived', [App\Http\Controllers\CashReceiptJournalTrash::class, 'index'])->name('CashReceiptJournalArchived');
Route::get('/GeneralJournalArchived', [App\Http\Controllers\GeneralJournalTrash::class, 'index'])->name('GeneralJournalArchived');



Route::get('/faqs', function () {
    return view('sidebarlinks.faqs');
});

// Route::get('/settings', function () {
//     return view('sidebarlinks.settings');
// });


Route::get('/ledgersheet', function () {
    return view('ledgersheet.ledgerSheetView');
});

Route::get('/ledgersheetarchive', function () {
    return view('ledgersheet.ledgerSheetView');
});

Route::get('/ledgersheet', [App\Http\Controllers\ledgerSheetController::class, 'index'])->name('LedgerSheet');
Route::get('/ledgersheetarchive', [App\Http\Controllers\ledgerSheetTrash::class, 'index'])->name('LedgerSheetArchive');




