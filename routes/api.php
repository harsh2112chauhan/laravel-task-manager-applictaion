<?php

use App\Http\Controllers\API\APITaskController;
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

Route::post('task', [APITaskController::class, 'create']);
Route::get('task', [APITaskController::class, 'index']);
Route::get('task/{id}', [APITaskController::class, 'GetTaskbyId']);
Route::put('task/{id}', [APITaskController::class, 'Update']);
Route::post('task/done/{id}', [APITaskController::class, 'MarkTaskasDone']);
Route::delete('task/{id}', [APITaskController::class, 'Delete']);
