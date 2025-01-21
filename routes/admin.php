<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AuthController,
    DashboardController,
    PageController,
    SubSectionController,
    ContactUsController,
    SettingController
};
//authenticate admin
Route::get('/admin', [AuthController::class, 'showLoginForm'])->name('admin');
Route::post('/submit-login', [AuthController::class, 'submitLogin'])->name('submit-login');
Route::post('logout', [AuthController::class, 'logout'])->name('submit-logout');

//forgot password
Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('forgot-password');
Route::post('/submit-forgot-password', [AuthController::class, 'submitForgotPassword'])->name('submit-forgot-password');

//Reset password
Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password', [AuthController::class, 'resetPasswordStore'])->name('submit-reset-password');

Route::group(['prefix' => 'admin'], function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //change password
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('show.change-password');
    Route::post('/submit-chanage-password', [AuthController::class, 'submitChangePassword'])->name('submit-change-password');

    //Profile update
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('show.profile');
    Route::post('/update/profile', [AuthController::class, 'submitProfileUpdate'])->name('submit.profileUpdate');
    Route::post('/check/email-unique', [AuthController::class, 'checkUnique'])->name('check.uniqueEmail');

    //Pages routes/;
    Route::get('/page/ajax/table', [PageController::class, 'ajaxTable'])->name('page.ajaxTable');
    Route::post('/page/unique/title', [PageController::class, 'checkUniqueTitle'])->name('page.checkUniqueTitle');
    Route::get('/page/parent/search', [PageController::class, 'fetchParentPages'])->name('page.fetchParentPages');
    Route::resource('page', PageController::class);

    //Sub Section routes;
    Route::get('/sub-section/ajax/table', [SubSectionController::class, 'ajaxTable'])->name('sub-section.ajaxTable');
    Route::post('/sub-section-change-status', [SubSectionController::class, 'status'])->name('sub-section.changeStatus');
    Route::resource('sub-section', SubSectionController::class);

    //Contact us routes
    Route::get('/contact-us/ajax/table', [ContactUsController::class, 'ajaxTable'])->name('contact-us.ajaxTable');
    Route::resource('contact-us', ContactUsController::class);

    //Setting routes
    Route::get('/setting', [SettingController::class, 'setting'])->name('setting.list');
    Route::post('/update/support', [SettingController::class, 'updateSupport'])->name('update.support');
});
