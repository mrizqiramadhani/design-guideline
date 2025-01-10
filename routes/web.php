<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ShowUnitController;
use App\Http\Controllers\IllustrationController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\IconographyController;
use App\Http\Controllers\TypographyController;
use App\Http\Controllers\QuestionController;


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
Route::get('/', [ShowUnitController::class, 'showShafwahGroupPage']);
Route::get('/shafwah-group', [ShowUnitController::class, 'showShafwahGroupPage'])->name('shafwah-group');
Route::get('/shafwah-holidays', [ShowUnitController::class, 'showShafwahHolidaysPage'])->name('shafwah-holidays');
Route::get('/shafwah-property', [ShowUnitController::class, 'showShafwahPropertyPage'])->name('shafwah-property');

//! route logo primary dan white
Route::get('/shafwah-group/logo-primary/{id}', [ShowUnitController::class, 'showPrimaryLogosShafwahGroup'])->name('logo-primary-sg');
Route::get('/shafwah-group/logo-white/{id}', [ShowUnitController::class, 'showWhiteLogosShafwahGroup'])->name('logo-white-sg');
Route::get('/shafwah-holidays/logo-primary/{id}', [ShowUnitController::class, 'showPrimaryLogosShafwahHolidays'])->name('logo-primary-sh');
Route::get('/shafwah-holidays/logo-white/{id}', [ShowUnitController::class, 'showWhiteLogosShafwahHolidays'])->name('logo-white-sh');
Route::get('/shafwah-property/logo-primary/{id}', [ShowUnitController::class, 'showPrimaryLogosShafwahProperty'])->name('logo-primary-srp');
Route::get('/shafwah-property/logo-white/{id}', [ShowUnitController::class, 'showWhiteLogosShafwahProperty'])->name('logo-white-srp');


//!download logo
Route::get('/download-logos/{id}', [ShowUnitController::class, 'downloadLogos'])->name('logos.download');

//download campaign
Route::get('/campaign/download/{id}', [ShowUnitController::class, 'downloadCampaign'])->name('campaign.download');


Route::get('/login', function () {
    return view('auth.login');
});

// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password.email-validation');
// })->name('forgot-password');
// Route::get('/reset-password', function () {
//     return view('auth.forgot-password.reset-password');
// })->name('reset-password');
// Route::get('/reset-password-success', function () {
//     return view('auth.forgot-password.reset-password-success');
// })->name('reset-password-success');

//! Auth Route
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//! Forgot password route
Route::get('/forgot-password', [PasswordController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/validate-email', [PasswordController::class, 'validateEmail'])->name('validate-email');

Route::middleware('validate-reset-flow:reset-password')->group(function () {
    Route::get('/reset-password', [PasswordController::class, 'showResetPassword'])->name('reset-password');
    Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('process-reset-password');
});

Route::middleware('validate-reset-flow:reset-password-success')->group(function () {
    Route::get('/reset-password-success', [PasswordController::class, 'showResetPasswordSuccess'])->name('reset-password-success');
});


//* Admin Route
Route::group(['middleware' => ['auth', 'startSessionByRole']], function () {
    Route::group(['middleware' => ['checkAdmin']], function () {

        // !route admin setting
        Route::post('/admin/change-email', [AdminController::class, 'changeEmail'])->name('admin.changeEmail');
        Route::post('/admin/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');

        //! route admin CRUD QUESTION 
        Route::get('admin/personal-information', [QuestionController::class, 'index'])->name('personal.information');
        Route::post('admin/security-questions', [QuestionController::class, 'store'])->name('security-questions.store');
        Route::post('admin/security-questions/{id}/validate', [QuestionController::class, 'validateAnswer'])->name('security-questions.validate');
        Route::put('admin/security-questions/{id}', [QuestionController::class, 'update'])->name('security-questions.update');
        Route::delete('admin/security-questions/{id}', [QuestionController::class, 'destroy'])->name('security-questions.destroy');


        //! route admin operator-list
        Route::post('/admin/add-operator', [AdminController::class, 'addOperator'])->name('admin.addOperator');
        Route::get('/admin/operator-list', [AdminController::class, 'showOperators'])->name('admin.show-operators');
        Route::get('/admin/operator/edit/{id}', [AdminController::class, 'editOperator'])->name('admin.editOperator');
        Route::put('/admin/operator/update/{id}', [AdminController::class, 'updateOperator'])->name('admin.updateOperator');
        Route::delete('/admin/operator/{id}', [AdminController::class, 'deleteOperator'])->name('admin.deleteOperator');
        Route::get('/admin/operator', function () {
            return view('admin.operator-admin');
        })->name('admin.operator-list');

        Route::get('/admin/dashboard', [DescriptionController::class, 'index'])->name('admin.dashboard');

        //! route admin description
        Route::get('admin/description', [DescriptionController::class, 'index'])->name('admin.description');
        Route::post('admin/description', [DescriptionController::class, 'store'])->name('admin.description.store');
        Route::get('admin/description/{id}/edit', [descriptionController::class, 'edit'])->name('admin.description.edit');
        Route::put('admin/description/{id}', [descriptionController::class, 'update'])->name('admin.description.update');
        Route::delete('admin/description/{id}', [descriptionController::class, 'destroy'])->name('admin.description.destroy');


        //! Route admin Logo
        Route::get('admin/logo', [LogoController::class, 'index'])->name('admin.logo');
        Route::post('admin/logo', [LogoController::class, 'store'])->name('admin.logo.store');
        Route::get('admin/logo/{id}/edit', [LogoController::class, 'edit'])->name('admin.logo.edit');
        Route::put('admin/logo/{id}', [LogoController::class, 'update'])->name('admin.logo.update');
        Route::delete('admin/logo/{id}', [LogoController::class, 'destroy'])->name('admin.logo.destroy');
        Route::delete('/admin/logo/photo/{id}/delete', [LogoController::class, 'deleteLogoPhoto'])->name('logo.deletePhoto');



        //! Color Palette Routes
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


        //! social media admin Routes
        Route::get('admin/social-media', [SocialMediaController::class, 'index'])->name('admin.social-media');
        Route::post('admin/social-media', [SocialMediaController::class, 'store'])->name('admin.social-media.store');
        Route::get('admin/social-media/{id}/edit', [SocialMediaController::class, 'edit'])->name('admin.social-media.edit');
        Route::put('admin/social-media/{id}', [SocialMediaController::class, 'update'])->name('admin.social-media.update');
        Route::delete('admin/social-media/{id}', [SocialMediaController::class, 'destroy'])->name('admin.social-media.destroy');

        //iconography routes
        Route::get('admin/iconography', [IconographyController::class, 'index'])->name('admin.iconography');
        Route::post('admin/iconography', [IconographyController::class, 'store'])->name('admin.iconography.store');
        Route::get('admin/iconography/{id}/edit', [IconographyController::class, 'edit'])->name('admin.iconography.edit');
        Route::put('admin/iconography/{id}', [IconographyController::class, 'update'])->name('admin.iconography.update');
        Route::delete('admin/iconography/{id}', [IconographyController::class, 'destroy'])->name('admin.iconography.destroy');

        //campaign routes
        Route::get('admin/campaign', [CampaignController::class, 'index'])->name('admin.campaign');
        Route::post('admin/campaign', [CampaignController::class, 'store'])->name('admin.campaign.store');
        Route::get('admin/campaign/{id}/edit', [CampaignController::class, 'edit'])->name('admin.campaign.edit');
        Route::put('admin/campaign/{id}', [CampaignController::class, 'update'])->name('admin.campaign.update');
        Route::delete('admin/campaign/{id}', [CampaignController::class, 'destroy'])->name('admin.campaign.destroy');

        // typography Admin Routes
        Route::get('admin/typography', [TypographyController::class, 'index'])->name('admin.typography');
        Route::post('admin/typography', [TypographyController::class, 'store'])->name('admin.typography.store');
        Route::get('admin/typography/{id}/edit', [TypographyController::class, 'edit'])->name('admin.typography.edit');
        Route::put('admin/typography/{id}', [TypographyController::class, 'update'])->name('admin.typography.update');
        Route::delete('admin/typography/{id}', [TypographyController::class, 'destroy'])->name('admin.typography.destroy');
    });

    Route::group(['middleware' => ['checkOperator']], function () {

        Route::get('/operator/dashboard', [DescriptionController::class, 'index'])->name('operator.dashboard');

        //! route operator description
        Route::get('operator/description', [DescriptionController::class, 'index'])->name('operator.description');
        Route::post('operator/description', [DescriptionController::class, 'store'])->name('operator.description.store');
        Route::get('operator/description/{id}/edit', [descriptionController::class, 'edit'])->name('operator.description.edit');
        Route::put('operator/description/{id}', [descriptionController::class, 'update'])->name('operator.description.update');
        Route::delete('operator/description/{id}', [descriptionController::class, 'destroy'])->name('operator.description.destroy');

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

        //! social media operator Routes
        Route::get('operator/social-media', [SocialMediaController::class, 'index'])->name('operator.social-media');
        Route::post('operator/social-media', [SocialMediaController::class, 'store'])->name('operator.social-media.store');
        Route::get('operator/social-media/{id}/edit', [SocialMediaController::class, 'edit'])->name('operator.social-media.edit');
        Route::put('operator/social-media/{id}', [SocialMediaController::class, 'update'])->name('operator.social-media.update');
        Route::delete('operator/social-media/{id}', [SocialMediaController::class, 'destroy'])->name('operator.social-media.destroy');

        //iconography routes
        Route::get('operator/iconography', [IconographyController::class, 'index'])->name('operator.iconography');
        Route::post('operator/iconography', [IconographyController::class, 'store'])->name('operator.iconography.store');
        Route::get('operator/iconography/{id}/edit', [IconographyController::class, 'edit'])->name('operator.iconography.edit');
        Route::put('operator/iconography/{id}', [IconographyController::class, 'update'])->name('operator.iconography.update');
        Route::delete('operator/iconography/{id}', [IconographyController::class, 'destroy'])->name('operator.iconography.destroy');

        //campaign routes
        Route::get('operator/campaign', [CampaignController::class, 'index'])->name('operator.campaign');
        Route::post('operator/campaign', [CampaignController::class, 'store'])->name('operator.campaign.store');
        Route::get('operator/campaign/{id}/edit', [CampaignController::class, 'edit'])->name('operator.campaign.edit');
        Route::put('operator/campaign/{id}', [CampaignController::class, 'update'])->name('operator.campaign.update');
        Route::delete('operator/campaign/{id}', [CampaignController::class, 'destroy'])->name('operator.campaign.destroy');

        // typography Routes
        Route::get('operator/typography', [TypographyController::class, 'index'])->name('operator.typography');
        Route::post('operator/typography', [TypographyController::class, 'store'])->name('operator.typography.store');
        Route::get('operator/typography/{id}/edit', [TypographyController::class, 'edit'])->name('operator.typography.edit');
        Route::put('operator/typography/{id}', [TypographyController::class, 'update'])->name('operator.typography.update');
        Route::delete('operator/typography/{id}', [TypographyController::class, 'destroy'])->name('operator.typography.destroy');
    });
});
