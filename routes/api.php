<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyShiftOffDaysController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\EmployeeShiftOffController;
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


Route::post('/company-shift-off-days', [CompanyShiftOffDaysController::class, 'create']);
Route::delete('company-shift-off-days/{id}',[CompanyShiftOffDaysController::class, 'delete']);
Route::get('company-shift-off-days',[CompanyShiftOffDaysController::class, 'index']);

# employee data
Route::group(['prefix' => 'employee'], function () {
    Route::post('/', [EmployeeController::class, 'create']);
    Route::get('/', [EmployeeController::class, 'index']);
    Route::put('/{id}', [EmployeeController::class, 'update']);
    Route::delete('/{id}', [EmployeeController::class, 'delete']);
});


Route::group(['prefix' => 'config'], function () {
    Route::post('/', [ConfigController::class, 'create']);
    Route::get('/', [ConfigController::class, 'index']);
    Route::put('/{id}', [ConfigController::class, 'update']);
    Route::delete('/{id}', [ConfigController::class, 'delete']);
});


Route::group(['prefix' => 'employee_shift_off'], function () {
    Route::post('/', [EmployeeShiftOffController::class, 'create']);
    Route::get('/', [EmployeeShiftOffController::class, 'index']);
    Route::put('/{id}', [EmployeeShiftOffController::class, 'update']);
    Route::delete('/{id}', [EmployeeShiftOffController::class, 'delete']);
});