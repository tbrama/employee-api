<?php

use App\Http\Controllers\EmployeeController;
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

Route::post('addemp', [EmployeeController::class, 'addemp']);
Route::get('listemp', [EmployeeController::class, 'listemp']);
Route::post('updateemp', [EmployeeController::class, 'updateemp']);
Route::post('deleteemp', [EmployeeController::class, 'deleteemp']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
