<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\UserController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


Route::group(['middleware' => 'jwt.auth'], function () {
    Route::resource('categorias', CategoriaController::class);
    Route::resource('users', UserController::class);
    Route::resource('almacens', AlmacenController::class);
    Route::resource('articulos', ArticuloController::class);
    Route::put('/resetpassword/{user}',[UserController::class,'resetPassword'])->name('users.resetpassword');

});