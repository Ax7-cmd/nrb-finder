<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/export-nrb', [App\Http\Controllers\API\V1\NrbController::class, 'export'])->name('export-nrb');
Route::get('/export-rma', [App\Http\Controllers\API\V1\RmaController::class, 'export'])->name('export-rma');
Route::get('/export-trp', [App\Http\Controllers\API\V1\TrpController::class, 'export'])->name('export-trp');
Route::get('/export-whs', [App\Http\Controllers\API\V1\WhsController::class, 'export'])->name('export-whs');
Route::get('/export-acc', [App\Http\Controllers\API\V1\AccController::class, 'export'])->name('export-acc');
Route::get('/export-fin', [App\Http\Controllers\API\V1\FinController::class, 'export'])->name('export-fin');

Auth::routes(['verify' => true]);
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('home', function () {
    return redirect('/dashboard');
});


Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*')->middleware('auth');

