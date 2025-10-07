<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('modules.dashboard.home');
});
