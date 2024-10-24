<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('shafwah-group.index-sg');
});

Route::get('/shafwah-group', function () {
    return view('shafwah-group.index-sg');
})->name('shafwah-group');

Route::get('/shafwah-holidays', function () {
    return view('shafwah-holidays.index-sh');
})->name('shafwah-holidays');

Route::get('/shafwah-property', function () {
    return view('shafwah-property.index-srp');
})->name('shafwah-property');

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard-admin');
});
Route::get('/operator/dashboard', function () {
    return view('operator.dashboard-operator');
});
