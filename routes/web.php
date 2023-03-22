<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SurveyQuestionController;
use App\Http\Controllers\Admin\PseudonymController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-all', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    die('cleared');
});


Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
        // Login and registration routes
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

        // Add the admin.authenticate route
        // Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [ResetPasswordController::class, 'reset']);
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

         //users
         Route::get('user', [UserController::class, 'index'])->name('user.index');
         Route::get('user/edit/{id}', [UserController::class, 'edit']);
         Route::post('user/update', [UserController::class, 'update'])->name('user.update');
         Route::get('user/delete/{id}', [UserController::class, 'destroy']);
         Route::get('user/details/{id}', [UserController::class, 'details']);
 
         //surveys
         Route::get('survey', [UserController::class, 'survey'])->name('user.survey');
         Route::get('delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
         Route::get('survey/details/{id}', [UserController::class, 'surveyDetails']);
 
         //partners
         Route::get('partners', [PartnerController::class, 'index'])->name('partners.index');
         Route::get('partners/add', [PartnerController::class, 'create'])->name('partners.create');
         Route::post('partners/store', [PartnerController::class, 'store'])->name('partners.store');
         Route::get('partners/edit/{id}', [PartnerController::class, 'edit']);
         Route::post('partners/update', [PartnerController::class, 'update'])->name('partners.update');
         Route::get('partners/delete/{id}', [PartnerController::class, 'destroy']);
 
         //Survey question & answers
         Route::get('questions', [SurveyQuestionController::class, 'index'])->name('questions.index');
         Route::get('questions/add', [SurveyQuestionController::class, 'create'])->name('questions.create');
         Route::post('questions/store', [SurveyQuestionController::class, 'store'])->name('questions.store');
         Route::get('questions/edit/{id}', [SurveyQuestionController::class, 'edit']);
         Route::post('questions/update', [SurveyQuestionController::class, 'update'])->name('questions.update');
         Route::get('questions/delete/{id}', [SurveyQuestionController::class, 'destroy']);
 
    });
});