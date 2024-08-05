<?php

use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\AuthController;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);

});

Route::middleware('jwt.auth')->controller(PostController::class)->group(function() {
    Route::get('/posts', 'index');
    Route::get('/posts/create', 'create');
    Route::post('/posts', 'store');
    Route::get('/posts/{post}', 'show');
    Route::get('/posts/{post}/edit', 'edit');
    Route::patch('/posts/{post}', 'update');
    Route::delete('/posts/{post}', 'destroy');
});
