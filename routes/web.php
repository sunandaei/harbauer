<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\WebScrapingController;


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
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/result', [ResultController::class, 'index'])->name('Result');






Route::get('/scrape', [WebScrapingController::class, 'scrapeWebsite']);


Route::any('/ajaxPortfolioSave', [PortfolioController::class, 'ajaxPortfolioSave'])->name('ajaxPortfolioSave');

Route::get('/ajaxExpiryDetails/{id}', [PortfolioController::class, 'getExpiryDetails']);

Route::get('/ajaxStrickDetails/{id}', [PortfolioController::class, 'ajaxStrickDetails']);

Route::get('/getPortfolioDetails/{id}', [PortfolioController::class, 'getPortfolioDetails']);

Route::any('/togglePortfolio', [PortfolioController::class, 'togglePortfolio'])->name('togglePortfolio');

Route::get('/getPortfolioDetails/{id}', [PortfolioController::class, 'getPortfolioDetails']);

Route::post('/updatePortfolio', [PortfolioController::class, 'updatePortfolio'])->name('updatePortfolio');




Route::get('/portfolio', [PortfolioController::class, 'index'])->name('Portfolio');

Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');

Route::get('/portfolio/store', [PortfolioController::class, 'store'])->name('portfolio.store');






Route::get('/position', [PositionController::class, 'index'])->name('position.index');

Route::any('/position/create', [PositionController::class, 'create'])->name('position.create');

Route::any('/position/edittable', [PositionController::class, 'edittable'])->name('position.edittable');

Route::any('/position/update/{position}', [PositionController::class, 'update'])->name('position.update');

Route::any('/position/store', [PositionController::class, 'store'])->name('position.store');

Route::delete('/position/delete/{id}',  [PositionController::class, 'destroy'])->name('position.destroy');

Route::delete('/position/deleteSelected',  [PositionController::class, 'deleteSelected'])->name('position.deleteSelected');


Route::get('/get-position-details/{positionId}',  [PositionController::class, 'getPositionDetails'])->name('get.position.details');



//option controller
Route::get('/options', [OptionController::class, 'index'])->name('options');






