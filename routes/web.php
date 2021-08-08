<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientTokenController;
use App\Http\Controllers\Note\NoteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

/**
 * Panel routes
 */
Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Client routes
 */
Route::get('/tokens/generate-token', [ClientTokenController::class, 'new'])->middleware('auth');
Route::post('/tokens/generate-token', [ClientTokenController::class, 'create'])->middleware('auth')->name('client_tokens.generate');
Route::get('/tokens/{clientToken}', [ClientTokenController::class, 'index'])->name('client_tokens.complete_profile');
Route::post('/tokens/{clientToken:token}', [ClientTokenController::class, 'completeProfile'])->name('client_tokens.complete_profile');
Route::get('/clients/create', [ClientController::class, 'create'])->middleware('auth')->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->middleware('auth')->name('clients.store');
Route::get('/clients', [ClientController::class, 'index'])->middleware('auth')->name('clients.index');
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->middleware('auth')->name('clients.edit');
Route::get('/clients/{client}', [ClientController::class, 'show'])->middleware('auth')->name('clients.show');
Route::put('/clients/{client}', [ClientController::class, 'update'])->middleware('auth')->name('clients.update');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->middleware('auth')->name('clients.destroy');

/**
 * Client note routes
 */
Route::get('/note', [NoteController::class, 'edit'])->middleware('auth')->name('notes.edit');

require __DIR__.'/auth.php';
