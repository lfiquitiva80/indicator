<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
//->middleware(['auth'])

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    
Route::resource('ssl', App\Http\Controllers\SslController::class);

});

Route::resource('payroll', App\Http\Controllers\PayrollController::class);

Route::get('indicenomina', [App\Http\Controllers\PayrollController::class,'indicenomina'])->name('indicenomina');
Route::get('seleccionaranios', [App\Http\Controllers\PayrollController::class,'seleccionaranios'])->name('seleccionaranios');
Route::get('escogeranios', [App\Http\Controllers\PayrollController::class,'escogeranios'])->name('escogeranios');
Route::get('comparativo', [App\Http\Controllers\PayrollController::class,'comparativo'])->name('comparativo');
Route::get('indicessl', [App\Http\Controllers\SslController::class,'indicenomina'])->name('indicessl');
Route::get('seleccionaraniosssl', [App\Http\Controllers\SslController::class,'seleccionaranios'])->name('seleccionaraniosssl');
Route::get('escogeraniossl', [App\Http\Controllers\SslController::class,'escogeranios'])->name('escogeraniosssl');
Route::get('comparativossl', [App\Http\Controllers\SslController::class,'comparativo'])->name('comparativossl');
Route::resource('excel', App\Http\Controllers\ExcelController::class);
Route::resource('costosfletes', App\Http\Controllers\FletesController::class);
Route::get('costosfletesmes', [App\Http\Controllers\FletesController::class,'fletesmes'])->name('fletesmes');
