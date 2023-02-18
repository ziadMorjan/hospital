<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HospitalController;

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
    return view('admin.dashbord');
});

Route::get('/welcome', [WelcomeController::class, 'welcome']);

Route::get('/hospital/index', [HospitalController::class, 'index']);
Route::get('/hospital/create', [HospitalController::class, 'create']);
Route::post('/hospital/store', [HospitalController::class, 'store']);
Route::get('/hospital/show/{id}', [HospitalController::class, 'show']);
Route::get('/hospital/edit/{id}', [HospitalController::class, 'edit']);
Route::post('/hospital/update/{id}', [HospitalController::class, 'update']);
Route::delete('/hospital/destroy/{id}', [HospitalController::class, 'destroy']);

Route::fallback(function () {
    return view('error404');
});