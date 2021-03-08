<?php

use Illuminate\Support\Facades\Route;
use Azuriom\Plugin\Dofus129\Controllers\LadderController;
use Azuriom\Plugin\Dofus129\Controllers\Dofus129HomeController;

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

Route::get('/', [Dofus129HomeController::class, 'index']);

Route::prefix('ladder')->name('ladder.')->group(function(){
    Route::get('/pvm', [LadderController::class, 'pvm'])->name('pvm');
    Route::get('/pvp', [LadderController::class, 'pvp'])->name('pvp');
});
