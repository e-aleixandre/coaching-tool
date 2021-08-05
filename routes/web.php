<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientTokenController;
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
Route::post('/tokens/generate-token', [ClientTokenController::class, 'create'])->middleware('auth')->name('client_token.generate');
Route::get('/tokens/{clientToken}', [ClientTokenController::class, 'index'])->name('client_token.complete_profile');
Route::post('/tokens/{clientToken:token}', [ClientTokenController::class, 'completeProfile'])->name('client_token.complete_profile');
Route::get('/clients/create', [ClientController::class, 'create'])->middleware('auth')->name('client.create');
Route::post('/clients', [ClientController::class, 'store'])->middleware('auth')->name('client.store');

require __DIR__.'/auth.php';
