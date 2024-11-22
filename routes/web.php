<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserDashboardController;

// user login and registration
Route::get('/', [RegistrationController::class, 'registration'])    ;
Route::get('registration', [RegistrationController::class, 'registration'])->name('registration');
Route::post('registration-post', [RegistrationController::class, 'registrationPost'])->name('registration-post');
Route::get('login', [RegistrationController::class, 'login'])->name('login');
Route::post('login-post', [RegistrationController::class, 'loginPost'])->name('login-post');
// admin login route
Route::get('admin-login', [AdminLoginController::class, 'admin_login'])->name('admin-login');
Route::post('admin-login-post', [AdminLoginController::class, 'adminLoginPost'])->name('admin-login-post');
// admin dashboard
Route::middleware(['auth.admin'])->group(function () {
Route::get('admin-dashboard', [DashboardController::class, 'dashboard'])->name('admin-dashboard');
Route::get('admin-user-list', [DashboardController::class, 'userList'])->name('admin-user-list');
Route::get('admin-novel-list', [DashboardController::class, 'novelList'])->name('admin-novel-list');
Route::post('admin-novel-check-status', [DashboardController::class, 'novelCheckStatus'])->name('admin-novel-check-status');
Route::post('admin-novel-status', [DashboardController::class, 'novelStatus'])->name('admin-novel-status');
Route::get('admin-user-delete/{id}', [DashboardController::class, 'deleteUser'])->name('admin-user-delete');
Route::get('admin-novel-delete/{id}', [DashboardController::class, 'deleteNovel'])->name('admin-novel-delete');
Route::get('admin-edit-novel/{id}', [DashboardController::class, 'editNovel'])->name('admin-edit-novel');
Route::post('admin-update-novel', [DashboardController::class, 'updateNovel'])->name('admin-update-novel');
Route::post('admin-user-status', [DashboardController::class, 'userStatus'])->name('admin-user-status');
Route::get('admin-logout', [DashboardController::class, 'logout'])->name('admin-logout');
});
// user dashboard
Route::middleware(['auth.user'])->group(function () {
Route::get('user-dashboard', [UserDashboardController::class, 'dashboard'])->name('user-dashboard');
Route::get('user-novel-list', [UserDashboardController::class, 'novelList'])->name('user-novel-list');
Route::get('user-add-novel', [UserDashboardController::class, 'addNovel'])->name('user-add-novel');
Route::get('user-edit-novel/{id}', [UserDashboardController::class, 'editNovel'])->name('user-edit-novel');
Route::post('user-update-novel', [UserDashboardController::class, 'updateNovel'])->name('user-update-novel');
Route::post('user-save-novel', [UserDashboardController::class, 'saveNovel'])->name('user-save-novel');
Route::get('user-logout', [UserDashboardController::class, 'logout'])->name('user-logout');
});