<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
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


Route::resource('/', ImageController::class)->only('index', 'create', 'store');

Route::get('/sortName', [HomeController::class, 'sortByName'])->name('sort.name');
Route::get('/sortTime', [HomeController::class, 'sortByTime'])->name('sort.time');
