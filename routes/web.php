<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ColorController;

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

//* Admin Route
Route::group(['middleware' => ['auth', 'startSessionByRole']], function () {
    Route::group(['middleware' => ['checkAdmin']], function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/add-operator', [AdminController::class, 'addOperator'])->name('admin.addOperator');
        Route::get('/admin/operator-list', [AdminController::class, 'showOperators'])->name('admin.show-operators');
        Route::get('/admin/operator/edit/{id}', [AdminController::class, 'editOperator'])->name('admin.editOperator');
        Route::put('/admin/operator/update/{id}', [AdminController::class, 'updateOperator'])->name('admin.updateOperator');
        Route::get('/admin/operator', function () {
            return view('admin.operator-admin');
        })->name('admin.operator-list');
        Route::get('/admin/deskripsi', function () {
            return view('admin.dashboard-admin');
        })->name('admin.deskripsi');
        Route::get('/admin/logo', function () {
            return view('admin.content.logo-admin');
        })->name('admin.logo');
        Route::get('/admin/color-palette', function () {
            return view('admin.content.color-admin');
        })->name('admin.color');
        Route::get('/admin/typography', function () {
            return view('admin.content.typography-admin');
        })->name('admin.typography');
        Route::get('/admin/illustration', function () {
            return view('admin.content.illustration-admin');
        })->name('admin.illustration');
        Route::get('/admin/social-media', function () {
            return view('admin.content.sosmed-admin');
        })->name('admin.social');
        Route::get('/admin/iconography', function () {
            return view('admin.content.iconography-admin');
        })->name('admin.iconography');
        Route::get('/admin/campaign', function () {
            return view('admin.content.campaign-admin');
        })->name('admin.campaign');

        // Color Palette Routes
        Route::get('/admin/color-palette', [ColorController::class, 'index'])->name('admin.color');
        Route::get('/admin/color-palette/create', [ColorController::class, 'create'])->name('admin.color.create');
        Route::post('/admin/color-palette', [ColorController::class, 'store'])->name('admin.color.store');
        Route::get('/admin/color-palette/{color}/edit', [ColorController::class, 'edit'])->name('admin.color.edit');
        Route::put('/admin/color-palette/{color}', [ColorController::class, 'update'])->name('admin.color.update');
        Route::delete('/admin/color-palette/{color}', [ColorController::class, 'destroy'])->name('admin.color.destroy');
    });

    Route::group(['middleware' => ['checkOperator']], function () {
        Route::get('/operator/dashboard', [OperatorController::class, 'index'])->name('operator.dashboard');
        Route::get('/operator/deskripsi', function () {
            return view('operator.dashboard-operator');
        })->name('operator.deskripsi');
        Route::get('/operator/logo', function () {
            return view('operator.content.logo-operator');
        })->name('operator.logo');
        Route::get('/operator/color-palette', function () {
            return view('operator.content.color-operator');
        })->name('operator.color');
        Route::get('/operator/typography', function () {
            return view('operator.content.typography-operator');
        })->name('operator.typography');
        Route::get('/operator/illustration', function () {
            return view('operator.content.illustration-operator');
        })->name('operator.illustration');
        Route::get('/operator/social-media', function () {
            return view('operator.content.sosmed-operator');
        })->name('operator.social');
        Route::get('/operator/iconography', function () {
            return view('operator.icontent.conography-operator');
        })->name('operator.iconography');
        Route::get('/operator/campaign', function () {
            return view('operator.content.campaign-operator');
        })->name('operator.campaign');
    });
});

Route::delete('/admin/operator/{id}', [AdminController::class, 'deleteOperator'])->name('admin.deleteOperator');