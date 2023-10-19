<?php

use App\Http\Controllers\ListsController;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\UtenteController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'rest/v1',
    'middleware' => 'cors'
], function(){
    Route::resource('users', UtenteController::class);
    Route::resource('todos', TodosController::class);
    Route::resource('lists', ListsController::class);
});

