<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\GatewayController;
use App\Http\Controllers\Admin\InventorController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SensorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get("/", [DashboardController::class, "index"])->name("dashboard");

Route::resource("role-permissions", RolePermissionController::class);

Route::get("/users/soft-deleted", [UserController::class, "softDeletedUsers"])->name("users.soft.deleted");
Route::post("/users/{slug}/restore", [UserController::class, "restore"])->name("users.restore");
Route::resource("users", UserController::class, ["parameters" => ["user" =>"slug"]]);

Route::resource("users/profile", ProfileController::class, ["parameters" => ["profile" => "slug"]]);
Route::post('/users/profile/update/email', [ProfileController::class, 'updateEmail'])->name('profile.email.update');
Route::post('/users/profile/update/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
Route::post('/users/profile/{slug}/reset/password', [ProfileController::class, 'resetPassword'])->name('profile.password.reset');

Route::resource("gateways", GatewayController::class, ["parameters" => ["gateway" => "slug"]]);

Route::resource("sensors", SensorController::class, ["parameters" => ["sensor" => "slug"]]);

Route::resource("buildings", BuildingController::class, ["parameters" => ["building" => "slug"]]);

Route::resource("areas", AreaController::class, ["parameters" => ["area" => "slug"]]);

Route::resource("floors", FloorController::class, ["parameters" => ["floor" => "slug"]]);

Route::resource("rooms", RoomController::class, ["parameters" => ["room" => "slug"]]);

Route::resource("inventors", InventorController::class, ["parameters" => ["inventor" => "slug"]]);

Route::resource("employees", EmployeeController::class, ["parameters" => ["employee" => "slug"]]);

Route::resource("reports", ReportController::class, ["parameters" => ["report" => "slug"]]);

Route::resource("notifications", NotificationController::class, ["parameters" => ["notification" => "slug"]]);

Route::post("logout", [LoginController::class, "logout"])->name("logout");
