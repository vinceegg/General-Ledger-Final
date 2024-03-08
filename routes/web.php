<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\GeneralJournalShow;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashReceiptJournalController;
use App\Livewire\CashReceiptJournalShow;
use App\Livewire\CheckDisbursementJournalShow;
use App\Livewire\CashDisbursementJournalShow;
use App\Livewire\GeneralLedgerShow;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/CKDJ', function () {
    return view('journals.CKDJ');
  });
  
  Route::get('/CRJ', function () {
      return view('journals.CRJ');
  });
  
  Route::get('/CDJ', function () {
      return view('journals.CDJ');
  });
  
  Route::get('/GJ', function () {
      return view('journals.GJ');
  });
  
  Route::get('/gl', function () {
      return view('journals.LS');
  });
  
  Route::get('/faqs', function () {
      return view('sidebarlinks.faqs');
  });
  
  Route::get('/settings', function () {
      return view('sidebarlinks.settings');
  });
  

Route::get('/GJ', [App\Http\Controllers\GeneralJournalController::class, 'index'])->name('GJ');
Route::get('/general-journal/trashed', [GeneralJournalShow::class, 'trashed'])->name('general-journal.trashed');

//Alternative routes for journals views (huwag idelete pls)

Route::get('/check_disbursement_journal', function () {
    return view('journals.CKDJ');
});

Route::get('/cash_receipt_journal', function () {
    return view('journals.CRJ');
});

Route::get('/cash_disbursement_journal', function () {
    return view('journals.CDJ');
});

Route::get('/general_journal', function () {
    return view('journals.CRJ');
});
Route::get('/general_ledger', function () {
    return view('journals.CKDJ');
});








//Routes for each table of journals
Route::get('/CRJ', [App\Http\Controllers\CashReceiptJournalController::class, 'index'])->name('CRJ');
Route::get('/CKDJ', [App\Http\Controllers\CheckDisbursementJournalController::class, 'index'])->name('CKDJ');
Route::get('/CDJ', [App\Http\Controllers\CashDisbursementJournalController::class, 'index'])->name('CDJ');
Route::get('/GJ', [App\Http\Controllers\GeneralJournalController::class, 'index'])->name('GJ');
Route::get('/LS', [App\Http\Controllers\GeneralLedgerController::class, 'index'])->name('LS');






//import/export routes

//Routes for CRJ:import/export
// Route::get('/file-import',[CashReceiptJournalController::class,'importViewCRJ'])->name('import-view');
// Route::get('/file-import',[CashReceiptJournalController::class,'importViewCKDJ'])->name('import-view');




//Routes for soft delete
Route::get('/cash-receipt-journal/trashedCashReceiptJournal', [CashReceiptJournalShow::class, 'trashedCashReceiptJournal'])->name('cash-receipt-journal.trashedCashReceiptJournal');

Route::get('/check-disbursement-journal/trashedCheckDisbursementJournal', [CheckDisbursementJournalShow::class, 'trashedCheckDisbursementJournal'])->name('check-disbursement-journal.trashedCheckDisbursementJournal');

Route::get('/cash-disbursement-journal/trashedCashDisbursementJournal', [CashDisbursementJournalShow::class, 'trashedCashDisbursementJournal'])->name('cash-disbursement-journal.trashedCashDisbursementJournal');

Route::get('/general-journal/trashedGeneralJournal', [GeneralJournalShow::class, 'trashedGeneralJournal'])->name('general-journal.trashedGeneralJournal');

Route::get('/general-ledger/trashedGeneralLedger', [GeneralLedgerShow::class, 'trashedGeneralLedger'])->name('general-ledger.trashedGeneralLedger');