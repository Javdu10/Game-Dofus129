<?php

use Illuminate\Support\Facades\Route;
use Azuriom\Plugin\Dofus129\Controllers\InstallController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [InstallController::class, 'index'])->name('index');
Route::post('/setup-account-database', [InstallController::class, 'credentialAccountDatabase'])->name('credentialAccountDatabase');

Route::get('/index-account-table', [InstallController::class, 'indexAccountTable'])->name('indexAccountTable');
Route::post('/setup-account-table', [InstallController::class, 'setupAccountTable'])->name('setupAccountTable');

Route::get('/index-character-table', [InstallController::class, 'indexCharacterTable'])->name('indexCharacterTable');
Route::post('/setup-character-table', [InstallController::class, 'setupCharacterTable'])->name('setupCharacterTable');

Route::get('/index-admin-account', [InstallController::class, 'indexAdminAccount'])->name('indexAdminAccount');
Route::post('/setup-admin-account', [InstallController::class, 'setupAdminAccount'])->name('setupAdminAccount');
