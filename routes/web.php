<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;


Route::get('/', function () {
    return view('dashboard');
});


//Routes for each table of journals
Route::get('/CRJ', [App\Http\Controllers\CashReceiptJournalController::class, 'index'])->name('CRJ');
Route::get('/CKDJ', [App\Http\Controllers\CheckDisbursementJournalController::class, 'index'])->name('CKDJ');
Route::get('/CDJ', [App\Http\Controllers\CashDisbursementJournalController::class, 'index'])->name('CDJ');
Route::get('/GJ', [App\Http\Controllers\GeneralJournalController::class, 'index'])->name('GJ');

Route::get('/AC', function () {
    return view('accounthomepage');
});


//ROUTES FOR ARCHIVED RECORDS
Route::get('/CashDisbursementJournalArchived', [App\Http\Controllers\CashDisbursementJournalTrash::class, 'index'])->name('CashDisbursementJournalArchived');
Route::get('/CheckDisbursementJournalArchived', [App\Http\Controllers\CheckDisbursementJournalTrash::class, 'index'])->name('CheckDisbursementJournalArchived');
Route::get('/CashReceiptJournalArchived', [App\Http\Controllers\CashReceiptJournalTrash::class, 'index'])->name('CashReceiptJournalArchived');
Route::get('/GeneralJournalArchived', [App\Http\Controllers\GeneralJournalTrash::class, 'index'])->name('GeneralJournalArchived');



Route::get('/faqs', function () {
    return view('sidebarlinks.faqs');
});

Route::get('/settings', function () {
    return view('sidebarlinks.settings');
});


Route::get('/ledgersheet', function () {
    return view('ledgersheet.ledgerSheetView');
});

Route::get('/ledgersheetarchive', function () {
    return view('ledgersheet.ledgerSheetView');
});

Route::get('/ledgersheet', [App\Http\Controllers\ledgerSheetController::class, 'index'])->name('LedgerSheet');
Route::get('/ledgersheetarchive', [App\Http\Controllers\ledgerSheetTrash::class, 'index'])->name('LedgerSheetArchive');




