<?php

use App\Http\Controllers\BinnacleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
--------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

Auth::routes();

Route::resource('states', StateController::class);             // ->middleware('Auth');
Route::resource('operators', OperatorController::class);       // ->middleware('Auth');
Route::resource('sectors', SectorController::class);           // ->middleware('Auth');
Route::resource('positions', PositionController::class);       // ->middleware('Auth');
Route::resource('providers', ProviderController::class);       // ->middleware('Auth');
Route::resource('items', ItemController::class);               // ->middleware('Auth');
Route::resource('parts', PartController::class);               // ->middleware('Auth');
Route::resource('tickets', TicketController::class);           // ->middleware('Auth');
Route::resource('binnacles', BinnacleController::class);       // ->middleware('Auth');
Route::resource('users', UserController::class);               // ->middleware('Auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tickets/export/pdf', [TicketController::class, 'exportTicketsPDF'])->name('tickets.export.pdf');
Route::get('item/{id}/qr', [ItemController::class, 'printItemQr'])->name('items.qr');
Route::get('/items/{item}/parts', [PartController::class, 'indexpart'])->name('items.parts');
