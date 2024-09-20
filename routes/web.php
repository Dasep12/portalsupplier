<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\DenyController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UnitsController;
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

Route::get('/dashboard', [DashboardController::class, 'index']);


// SUPPLIER ROUTES
Route::get('/supplier', [SupplierController::class, 'index']);
Route::get('/jsonSupplierList', [SupplierController::class, 'jsonSupplierList']);
Route::post('/jsonCrudSupplier', [SupplierController::class, 'jsonCrudSupplier']);


// UNITS ROUTES
Route::get('/units', [UnitsController::class, 'index']);
Route::get('/jsonUnitsList', [UnitsController::class, 'jsonUnitsList']);
Route::get('/jsonUnitsListDetail', [UnitsController::class, 'jsonUnitsListDetail']);
Route::post('/jsonCrudUnits', [UnitsController::class, 'jsonCrudUnits']);
Route::get('/jsonParent', [UnitsController::class, 'jsonParent']);


// CATEGORY ROUTES
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/jsonCategoryList', [CategoryController::class, 'jsonCategoryList']);
Route::post('/jsonCrudCategory', [CategoryController::class, 'jsonCrudCategory']);


// PART ROUTES
Route::get('/part', [PartController::class, 'index']);
Route::get('/jsonPartList', [PartController::class, 'jsonPartList']);
Route::post('/jsonCrudPart', [PartController::class, 'jsonCrudPart']);
Route::get('/jsonListSupplier', [PartController::class, 'jsonListSupplier']);
Route::get('/jsonListCategory', [PartController::class, 'jsonListCategory']);
Route::get('/jsonListPackage', [PartController::class, 'jsonListPackage']);
Route::get('/jsonListUnits', [PartController::class, 'jsonListUnits']);
Route::post('/loadPart', [PartController::class, 'loadPart']);
Route::post('/uploadPart', [PartController::class, 'uploadPart']);

// Route::middleware('check.sessionLogin')->prefix('/')->group(function () {
//     Route::get('/', [AuthController::class, 'index']);
// });

// Route::get('/administrator/deny', [DenyController::class, 'index'])->middleware('check.session');
// Route::post('/auth', [AuthController::class, 'Auth']);
// Route::get('/logout', [LogoutController::class, 'index']);
