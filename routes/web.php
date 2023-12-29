<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnectController;   
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
    return view('welcome');
});

Route::get('/googleLogin', [ConnectController::class, 'googleLogin']);

Route::get('/auth/google/callback', [ConnectController::class, 'googleHandle']);


// Route::get('/microsoftLogin', [ConnectController::class, 'microsoftLogin']);

// Route::get('/auth/microsoft/callback', [ConnectController::class, 'microsoftHandle']);




Route::get('/microsoftLogin', [ConnectController::class, 'microsoftLogin'])->name('login');
Route::get('/auth/microsoft/callback', [ConnectController::class, 'microsoftHandle']);
Route::get('/auth/microsoft/callback/ajax', [ConnectController::class, 'microsoftHandleajax']);