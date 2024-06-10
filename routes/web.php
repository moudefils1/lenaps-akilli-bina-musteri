<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route("admin.dashboard");
});

Route::controller(ForgotPasswordController::class)->group(function (){
    Route::get("/forgot-password", "showForgotPasswordForm")->name("password.request");
    Route::post("/forgot-password", "sendResetLink")->name("password.email");
})->middleware("guest");

/*Route::controller(ResetPasswordController::class)->group(function (){
    Route::get("/reset-password/{token}", "showResetPasswordForm")->name("password.reset");
    Route::post("/reset-password", "resetPasswordPost")->name("password.reset.post");
})->middleware("guest");*/

Route::controller(LoginController::class)->group(function () {
    Route::get("/login", "index")->name("login");
    Route::post("/login", "login")->name("login.login");
})->middleware("guest");

//Route::get('/{any}', [AppController::class, 'index'])->where('any', '.*');
