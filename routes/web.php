<?php

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
Route::get('/tokens/{clientToken}', [ClientTokenController::class, 'index'])->name('client_token.complete_profile');
Route::post('/tokens/{clientToken:token}', [ClientTokenController::class, 'completeProfile'])->name('client_token.complete_profile');

require __DIR__.'/auth.php';
