<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\DashboardController;
use App\Models\LedgerSheetModel;
use App\Models\CDJ_SundryModel;
use App\Models\CRJ_SundryModel;
use App\Models\CKDJ_SundryModel;
use App\Models\GeneralJournal_AccountCodesModel;

Route::get('/', function () {
    return view('auth.register');
});

Route::resource('verify', TwoFactorController::class);

// Route::get('/dashboard',  function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'two_factor'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'two_factor'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
require __DIR__.'/auth.php';

//Routes for each table of journals
Route::get('/CRJ', [App\Http\Controllers\CashReceiptJournalController::class, 'index'])->name('CRJ');
Route::get('/CKDJ', [App\Http\Controllers\CheckDisbursementJournalController::class, 'index'])->name('CKDJ');
Route::get('/CDJ', [App\Http\Controllers\CashDisbursementJournalController::class, 'index'])->name('CDJ');
Route::get('/GJ', [App\Http\Controllers\GeneralJournalController::class, 'index'])->name('GJ');
Route::get('/LS', [App\Http\Controllers\GeneralLedgerController::class, 'index'])->name('LS');

Route::get('/AC', function () {
    return view('accounthomepage');
});

//RoutesLedgerSheet
Route::get('/LedgerSheets', [App\Http\Controllers\LedgerSheetController::class, 'index'])->name('LedgerSheet');
Route::get('/LedgerSheetArchived', [App\Http\Controllers\LedgerSheetTrash::class, 'index'])->name('LedgerSheetArchived');

//ROUTES FOR ARCHIVED RECORDS
Route::get('/CashDisbursementJournalArchived', [App\Http\Controllers\CashDisbursementJournalTrash::class, 'index'])->name('CashDisbursementJournalArchived');
Route::get('/CheckDisbursementJournalArchived', [App\Http\Controllers\CheckDisbursementJournalTrash::class, 'index'])->name('CheckDisbursementJournalArchived');
Route::get('/CashReceiptJournalArchived', [App\Http\Controllers\CashReceiptJournalTrash::class, 'index'])->name('CashReceiptJournalArchived');
Route::get('/GeneralJournalArchived', [App\Http\Controllers\GeneralJournalTrash::class, 'index'])->name('GeneralJournalArchived');
Route::get('/CashLocalTreasuryArchived', [App\Http\Controllers\GeneralLedgerTrash::class, 'index'])->name('CashLocalTreasuryArchived');


Route::get('/faqs', function () {
    return view('sidebarlinks.faqs');
});



