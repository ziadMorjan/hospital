<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\DoctorController;


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

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/', function () {
        return view('admin.home');
    })->name('adminHome');
    Route::resource('hospitals', HospitalController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('doctors', DoctorController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('change-password', [AuthController::class, 'change_password'])->name('admin.change-password');
    Route::post('post-change-password', [AuthController::class, 'post_change_password'])->name('admin.post-change-password');
});

Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('post-login', [AuthController::class, 'post_login'])->name('admin.post-login');
});

Route::get('/welcome', [WelcomeController::class, 'welcome']);
Route::fallback(function () {
    return view('error404');
});
