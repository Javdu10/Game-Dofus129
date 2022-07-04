<?php

use Azuriom\Plugin\Dofus129\Controllers\Dofus129HomeController;
use Azuriom\Plugin\Dofus129\Controllers\LadderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" middleware group and your plugin name
| as prefix. Now create something great!
|
*/

Route::prefix('ladder')->name('ladder.')->group(function () {
    Route::get('/pvm', [LadderController::class, 'pvm'])->name('pvm');
    Route::get('/pvp', [LadderController::class, 'pvp'])->name('pvp');
});

Route::post('/update_character', [Dofus129HomeController::class, 'update_character'])->name('update_character');

Route::prefix('accounts')->name('accounts.')->middleware('auth')->group(function () {
    Route::get('/', [Dofus129HomeController::class, 'index'])->name('index');
    Route::post('/', [Dofus129HomeController::class, 'store'])->name('store');
    Route::post('/update/{accountId}/new-password', [Dofus129HomeController::class, 'updatePassword'])->name('update-password');
});
