<?php

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

Route::get('/', function () {
    return view('admin.home');
})->name('home');

Route::get('/welcome', [WelcomeController::class, 'welcome']);

Route::resource('hospitals', HospitalController::class);
Route::resource('majors', MajorController::class);
Route::resource('doctors', DoctorController::class);


Route::fallback(function () {
    return view('error404');
});
