<?php

use App\Http\Controllers\GithubController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** Github api */
Route::get('fetch-all-repo', [GithubController::class, 'runJob']);
Route::get('php', [GithubController::class, 'index']);
Route::get('popularity/php', [GithubController::class, 'popular']);
Route::get('activity/php', [GithubController::class, 'activity']);
