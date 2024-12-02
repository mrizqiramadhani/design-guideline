<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ShowUnitController;
use App\Http\Controllers\IllustrationController;


// Route::get('/', function () {
//     return view('shafwah-group.index-sg');
// });

// Route::get('/shafwah-group', function () {
//     return view('shafwah-group.index-sg');
// })->name('shafwah-group');

// Route::get('/shafwah-holidays', function () {
//     return view('shafwah-holidays.index-sh');
// })->name('shafwah-holidays');

// Route::get('/shafwah-property', function () {
//     return view('shafwah-property.index-srp');
// })->name('shafwah-property');

// Route::get('shafwah-group/logo-primary', function () {
//     return view('shafwah-group.logo.logo-primary');
// })->name('logo-primary-sg');
// Route::get('shafwah-group/logo-white', function () {
//     return view('shafwah-group.logo.logo-white');
// })->name('logo-white-sg');

//* route Logo Unit bisnis
Route::get('/', [ShowunitController::class, 'showShafwahGroupPage']);
Route::get('/shafwah-group', [ShowunitController::class, 'showShafwahGroupPage'])->name('shafwah-group');
Route::get('/shafwah-holidays', [ShowunitController::class, 'showShafwahHolidaysPage'])->name('shafwah-holidays');
Route::get('/shafwah-property', [ShowunitController::class, 'showShafwahPropertyPage'])->name('shafwah-property');

//! route logo primary dan white
Route::get('/shafwah-group/logo-primary/{id}', [ShowunitController::class, 'showPrimaryLogosShafwahGroup'])->name('logo-primary-sg');
Route::get('/shafwah-group/logo-white/{id}', [ShowunitController::class, 'showWhiteLogosShafwahGroup'])->name('logo-white-sg');
Route::get('/shafwah-holidays/logo-primary/{id}', [ShowunitController::class, 'showPrimaryLogosShafwahHolidays'])->name('logo-primary-sh');
Route::get('/shafwah-holidays/logo-white/{id}', [ShowunitController::class, 'showWhiteLogosShafwahHolidays'])->name('logo-white-sh');
Route::get('/shafwah-property/logo-primary/{id}', [ShowunitController::class, 'showPrimaryLogosShafwahProperty'])->name('logo-primary-srp');
Route::get('/shafwah-property/logo-white/{id}', [ShowunitController::class, 'showWhiteLogosShafwahProperty'])->name('logo-white-srp');



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


        //! Route admin Logo
        Route::get('admin/logo', [LogoController::class, 'index'])->name('admin.logo');
        Route::post('admin/logo', [LogoController::class, 'store'])->name('admin.logo.store');
        Route::get('admin/logo/{id}/edit', [LogoController::class, 'edit'])->name('admin.logo.edit');
        Route::put('admin/logo/{id}', [LogoController::class, 'update'])->name('admin.logo.update');
        Route::delete('admin/logo/{id}', [LogoController::class, 'destroy'])->name('admin.logo.destroy');
        Route::delete('/admin/logo/photo/{id}/delete', [LogoController::class, 'deleteLogoPhoto'])->name('logo.deletePhoto');



        // Color Palette Routes
        Route::get('/admin/color-palette', [ColorController::class, 'index'])->name('admin.color');
        Route::get('/admin/color-palette/create', [ColorController::class, 'create'])->name('admin.color.create');
        Route::post('/admin/color-palette', [ColorController::class, 'store'])->name('admin.color.store');
        Route::get('/admin/color-palette/{color}/edit', [ColorController::class, 'edit'])->name('admin.color.edit');
        Route::put('/admin/color-palette/{color}', [ColorController::class, 'update'])->name('admin.color.update');
        Route::delete('/admin/color-palette/{color}', [ColorController::class, 'destroy'])->name('admin.color.destroy');

        Route::get('/admin/typography', function () {
            return view('admin.content.typography-admin');
        })->name('admin.typography');


        //! illustration Admin Routes
        Route::get('admin/illustration', [IllustrationController::class, 'index'])->name('admin.illustration');
        Route::post('admin/illustration', [IllustrationController::class, 'store'])->name('admin.illustration.store');
        Route::get('admin/illustration/{id}/edit', [IllustrationController::class, 'edit'])->name('admin.illustration.edit');
        Route::put('admin/illustration/{id}', [IllustrationController::class, 'update'])->name('admin.illustration.update');
        Route::delete('admin/illustration/{id}', [IllustrationController::class, 'destroy'])->name('admin.illustration.destroy');


        Route::get('/admin/social-media', function () {
            return view('admin.content.sosmed-admin');
        })->name('admin.social');
        Route::get('/admin/iconography', function () {
            return view('admin.content.iconography-admin');
        })->name('admin.iconography');
        Route::get('/admin/campaign', function () {
            return view('admin.content.campaign-admin');
        })->name('admin.campaign');
    });

    Route::group(['middleware' => ['checkOperator']], function () {
        Route::get('/operator/dashboard', [OperatorController::class, 'index'])->name('operator.dashboard');
        Route::get('/operator/deskripsi', function () {
            return view('operator.dashboard-operator');
        })->name('operator.deskripsi');
        // Route::get('/operator/logo', function () {
        //     return view('operator.content.logo-operator');
        // })->name('operator.logo');

        //! Route operator Logo
        Route::get('operator/logo', [LogoController::class, 'index'])->name('operator.logo');
        Route::post('operator/logo', [LogoController::class, 'store'])->name('operator.logo.store');
        Route::get('operator/logo/{id}/edit', [LogoController::class, 'edit'])->name('operator.logo.edit');
        Route::put('operator/logo/{id}', [LogoController::class, 'update'])->name('operator.logo.update');
        Route::delete('operator/logo/{id}', [LogoController::class, 'destroy'])->name('operator.logo.destroy');
        Route::delete('/operator/logo/photo/{id}/delete', [LogoController::class, 'deleteLogoPhoto'])->name('logo.deletePhoto');

        // Color Palette Routes
        Route::get('/operator/color-palette', [ColorController::class, 'index'])->name('operator.color');
        Route::get('/operator/color-palette/create', [ColorController::class, 'create'])->name('operator.color.create');
        Route::post('/operator/color-palette', [ColorController::class, 'store'])->name('operator.color.store');
        Route::get('/operator/color-palette/{color}/edit', [ColorController::class, 'edit'])->name('operator.color.edit');
        Route::put('/operator/color-palette/{color}', [ColorController::class, 'update'])->name('operator.color.update');
        Route::delete('/operator/color-palette/{color}', [ColorController::class, 'destroy'])->name('admin.color.destroy');

        Route::get('/operator/typography', function () {
            return view('operator.content.typography-operator');
        })->name('operator.typography');


        //! illustration operator Routes
        Route::get('operator/illustration', [IllustrationController::class, 'index'])->name('operator.illustration');
        Route::post('operator/illustration', [IllustrationController::class, 'store'])->name('operator.illustration.store');
        Route::get('operator/illustration/{id}/edit', [IllustrationController::class, 'edit'])->name('operator.illustration.edit');
        Route::put('operator/illustration/{id}', [IllustrationController::class, 'update'])->name('operator.illustration.update');
        Route::delete('operator/illustration/{id}', [IllustrationController::class, 'destroy'])->name('operator.illustration.destroy');

        Route::get('/operator/social-media', function () {
            return view('operator.content.sosmed-operator');
        })->name('operator.social');
        Route::get('/operator/iconography', function () {
            return view('operator.content.iconography-operator');
        })->name('operator.iconography');
        Route::get('/operator/campaign', function () {
            return view('operator.content.campaign-operator');
        })->name('operator.campaign');
    });
});

Route::delete('/admin/operator/{id}', [AdminController::class, 'deleteOperator'])->name('admin.deleteOperator');
