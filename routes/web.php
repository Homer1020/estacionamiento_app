<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TerminalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('terminal', [TerminalController::class, 'index'])->name('terminals.index');
Route::post('terminal/registrar-entrada', [TerminalController::class, 'store'])->name('terminals.store');
Route::put('terminal/{id}/salida', [TerminalController::class, 'update'])->name('terminals.update');
Route::delete('terminal/{transaction}/eliminar', [TerminalController::class, 'destroy'])->name('terminals.destroy');
Route::post('terminal/{transaction}/facturar', [TerminalController::class, 'checkout'])->name('terminals.checkout');
Route::get('terminal/{transaction}/facturar', [TerminalController::class, 'checkoutConfirm'])->name('terminals.checkoutConfirm');

Route::get('terminal/factura/{invoice}', InvoiceController::class)->name('invoices.show');

/**
 * RUTAS RESERVAS
 */
Route::resource('reservaciones', ReservationsController::class)
    ->parameters([
        'reservaciones' => 'reservation'
    ]);
Route::get('reservaciones/{transaction}/facturar', [TerminalController::class, 'checkoutConfirm'])->name('reservaciones.checkoutConfirm');

/**
 * RUTAS SERVICIOS
 */
Route::resource('servicios', ServiceController::class)->names('services');