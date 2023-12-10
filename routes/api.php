<?php

use App\Http\Controllers\AnswerContoller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/login', [AuthController::class,"login"]);
Route::post('/register', [AuthController::class,"register"]);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class,"me"]);
Route::middleware('auth:sanctum')->post('/revokeToken', [AuthController::class,"revokeToken"]);

Route::prefix('surveys')->middleware("auth:sanctum")->group(function () {
    Route::get('/', [SurveyController::class, 'index'])->name('index');
});
Route::prefix('questions')->middleware("auth:sanctum")->group(function () {
    Route::get('/{surveyId}', [QuestionController::class, 'index'])->name('index');
});
Route::prefix('client')->group(function () {
    Route::get('/questions/{surveyId}', [QuestionController::class, 'index']);
});
Route::prefix('answers')->group(function () {
    Route::middleware('auth:sanctum')->get('/', [AnswerContoller::class, 'index']);
    Route::post('/', [AnswerContoller::class, 'store']);
    //Route::middleware('auth:sanctum')->get('/{answerId}', [AnswerContoller::class, 'index']);
});
Route::prefix('participants')->group(function () {
    Route::middleware('auth:sanctum')->get('/', [ParticipantController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/', [ParticipantController::class, 'store']);
});
