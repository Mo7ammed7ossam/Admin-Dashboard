<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OptionsController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [AuthenticatedSessionController::class, 'create'])
->name('login');


Route::middleware(['auth', 'admin'])->name('admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});



require __DIR__ . '/auth.php';
