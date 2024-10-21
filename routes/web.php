<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExcelController;




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

Auth::routes();
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');




Route::get('/', function () {
    return redirect()->route('login');
});

//Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/result', [ResultController::class, 'index'])->name('Result');

Route::get('/get-blocks', [ResultController::class, 'getBlocks']);
Route::get('/get-panchayats', [ResultController::class, 'getPanchayats']);

Route::get('/analyticalSchemeData', [ResultController::class, 'analyticalSchemeData'])->name('analyticalSchemeData');

Route::get('/analyticalDataMonthly', [ResultController::class, 'analyticalDataMonthly'])->name('analyticalDataMonthly');

Route::get('/deviceAnalyticalDataMonthly', [ResultController::class, 'deviceAnalyticalDataMonthly'])->name('deviceAnalyticalDataMonthly');

Route::get('/stateData', [ResultController::class, 'stateData'])->name('stateData');


Route::get('/upload', [ExcelController::class, 'showUploadForm'])->name('uploadForm');
Route::post('/uploadExcel', [ExcelController::class, 'uploadExcel'])->name('uploadExcel');





