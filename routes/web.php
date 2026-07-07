<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/audition', function () {
    return view('audition.index');
});

Route::get('/audition/form', function () {
    return view('audition.form');
});
