<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PersonController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/personas')->group(function (){
    Route::get('/',[PersonController::class, 'get']);
    Route::get('/{id}',[PersonController::class, 'getById']);
    Route::post('/',[PersonController::class, 'create']);
    Route::put('/{id}',[PersonController::class, 'update']);
    Route::delete('/{id}',[PersonController::class, 'delete']);
});