<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\StaticPageController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');
Route::get('/about', function () {
    return view('pages.about');
})->name('about');
// Static page
Route::get('/pages/accounting-basics', [StaticPageController::class,'accountingBasics'])->name('pages.accounting-basics');

// Accounts CRUD
Route::resource('accounts', AccountsController::class)->except(['show']);

// Journal entries CRUD
Route::get('journal', [JournalController::class,'index'])->name('journal.index');
Route::get('journal/create', [JournalController::class,'create'])->name('journal.create');
Route::post('journal', [JournalController::class,'store'])->name('journal.store');
Route::get('journal/{journal}', [JournalController::class,'show'])->name('journal.show');
Route::delete('journal/{journal}', [JournalController::class,'destroy'])->name('journal.destroy');
