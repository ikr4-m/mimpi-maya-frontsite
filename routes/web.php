<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::controller(IndexController::class)
    ->name('index.')
    ->group(fn () => [
    Route::get('/', 'home')->name('home'),

    Route::prefix('/audition')
        ->name('audition.')
        ->group(fn () => [
        Route::get('/', 'audition')->name('index'),
        Route::get('/form', 'auditionForm')->name('form'),
    ]),
]);
