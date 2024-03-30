<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\UserReadingIntervalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("register",[UserController::class,'register']);

Route::post('login', [UserController::class,'login'])->name('login');

Route::group(['middleware' => 'auth:api'], function(){

    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

    Route::resources([
        'books' => BookController::class,
        'user-reading-intervals' => UserReadingIntervalController::class,
    ]);

    Route::get('/top-recommended-books', [UserReadingIntervalController::class, 'topRecommendedBooks'])->name('recommended-books');

});
