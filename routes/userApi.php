<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::post('/auth_test', [App\Http\Controllers\JsonResultsController::class, 'authTest']);
Route::post('/sanctum/token', [UserController::class, 'authToken']);
