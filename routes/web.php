<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;

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

//! Auth Route
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'startSessionByRole']], function () {
    Route::group(['middleware' => ['checkAdmin']], function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/add-operator', [AdminController::class, 'addOperator'])->name('admin.addOperator');
    });

    Route::group(['middleware' => ['checkOperator']], function () {
        Route::get('/operator/dashboard', [OperatorController::class, 'index'])->name('operator.dashboard');
    });
});
