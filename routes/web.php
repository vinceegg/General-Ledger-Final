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


//ROUTES FOR ARCHIVED RECORDS
Route::get('/CashLocalTreasuryArchived', [App\Http\Controllers\GeneralLedgerTrash::class, 'index'])->name('CashLocalTreasuryArchived');

Route::get('/faqs', function () {
    return view('sidebarlinks.faqs');
});

Route::get('/settings', function () {
    return view('sidebarlinks.settings');
});



  



