<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;


Route::get('/', function () {
    return view('auth.register');
});

Route::resource('verify', TwoFactorController::class);

Route::get('/dashboard',  function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'two_factor'])->name('dashboard');


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

//Routes for Account Codes
Route::get('/CashLocalTreasury', [App\Http\Controllers\CashLocalTreasury::class, 'index'])->name('CashLocalTreasury');
Route::get('/CashinBankLocalCurrencyCurrentAccount', [App\Http\Controllers\CashinBankLocalCurrencyCurrentAccountController::class, 'index'])->name('CashinBankLocalCurrencyCurrentAccount');
Route::get('/PettyCash', [App\Http\Controllers\LS2PettyCashController::class, 'index'])->name('PettyCash');
Route::get('/CashinBankLocalCurrencyTimeDeposits', [App\Http\Controllers\CashinBankLocalCurrencyTimeDepositsController::class, 'index'])->name('CashinBankLocalCurrencyTimeDeposits');

Route::get('/AccountsReceivable', [App\Http\Controllers\AccountsReceivableController::class, 'index'])->name('AccountsReceivable');

//ROUTES FOR ARCHIVED RECORDS
Route::get('/CashLocalTreasuryArchived', [App\Http\Controllers\GeneralLedgerTrash::class, 'index'])->name('CashLocalTreasuryArchived');
Route::get('/CashinBankLocalCurrencyCurrentAccountArchived', [App\Http\Controllers\CashinBankLocalCurrencyCurrentAccountTrash::class, 'index'])->name('CashinBankLocalCurrencyCurrentAccountArchived');
Route::get('/PettyCashArchived', [App\Http\Controllers\LS2PettyCashTrash::class, 'index'])->name('PettyCashArchived');
Route::get('/CashinBankLocalCurrencyTimeDepositsArchived', [App\Http\Controllers\CashinBankLocalCurrencyTimeDepositsTrash::class, 'index'])->name('CashinBankLocalCurrencyTimeDepositsArchived');
Route::get('/AccountsReceivableArchived', [App\Http\Controllers\AccountsReceivableTrash::class, 'index'])->name('AccountsReceivableArchived');


Route::get('/faqs', function () {
    return view('sidebarlinks.faqs');
});

Route::get('/settings', function () {
    return view('sidebarlinks.settings');
});



  



