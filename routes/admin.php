<?php

use Azuriom\Plugin\Dofus129\Controllers\Admin\AdminController;
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

Route::get('/', [AdminController::class, 'index'])->name('index');
Route::get('/certificate', [AdminController::class, 'certificate'])->name('certificate');
Route::get('/generate-certificate', [AdminController::class, 'generateCertificate'])->name('generate-certificate');
Route::get('/test-connection', [AdminController::class, 'testConnection'])->name('test-connection');

Route::post('/', [AdminController::class, 'updateSettings'])->name('settings');

Route::post('/test_account_creation', [AdminController::class, 'testAccountCreation'])->name('test_account_creation');
