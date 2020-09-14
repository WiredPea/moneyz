<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontPageController@index');

Route::middleware(ProtectAgainstSpam::class)->group(function() {
    Auth::routes();
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(Authenticate::class)->group(function() {
    Route::resource('assets',AssetsController::class);
    Route::post('uploadtransactions', [\App\Http\Controllers\TransactionProcessController::class, 'upload'])->name('uploadTransactions');
});
