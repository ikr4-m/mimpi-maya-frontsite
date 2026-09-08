<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::controller(IndexController::class)
    ->name('index.')
    ->group(fn () => [
    Route::get('/', 'home')->name('home'),

    Route::prefix('/talent')
        ->name('talent.')
        ->group(fn () => [
        Route::get('/', 'talent')->name('index'),
        Route::get('/{vtuber_name}', 'talentShow')->name('show'),
    ]),

    Route::get('/project', 'project')->name('project'),
    Route::get('/about', 'about')->name('about'),

    Route::prefix('/audition')
        ->name('audition.')
        ->group(fn () => [
        Route::get('/', 'auditionIndex')->name('index'),
        Route::get('/{slug}', 'auditionShow')->name('show'),
        Route::get('/{slug}/form', 'auditionForm')->name('form'),
    ]),
]);
