<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserSurveyController;
use App\Http\Controllers\API\PartnerController;
use App\Http\Controllers\API\SurveyQuestionController;
use App\Http\Controllers\API\VerificationController;
use App\Http\Controllers\API\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::get('/signin/google', [RegisterController::class, 'redirectToGoogle']);
Route::get('/signin/google/callback', [RegisterController::class, 'handleGoogleCallback']);

/* New Added Routes */

Route::get('account/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify'); 


   
Route::middleware('auth:api')->group( function () {
    Route::post('logout', [RegisterController::class, 'logout']);

    Route::post('/verify', [VerificationController::class, 'verify']);
    Route::post('/check', [VerificationController::class, 'check']);
    //User's survey
    Route::get('user/survey', [UserSurveyController::class, 'index']);
    Route::post('create/user/survey', [UserSurveyController::class, 'createUserSurvey']);

    //Partners
    Route::get('partners', [PartnerController::class, 'index']);

    //Questions/Answers
    Route::get('survey/question/answers', [SurveyQuestionController::class, 'index']);

    Route::get('dynamic/documents', [SettingController::class, 'dynamicDocuments']);
    Route::get('faqs', [SettingController::class, 'faqs']);
    
});
