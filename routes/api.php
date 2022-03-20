<?php

// use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/jurusan',[JurusanController::class, 'index']);
// Route::post('/jurusan',[JurusanController::class, 'store']);
// Route::get('/jurusan/{id}',[JurusanController::class, 'show']);
// Route::put('/jurusan/{id}',[JurusanController::class, 'update']);
// Route::delete('/jurusan/{id}',[JurusanController::class, 'destroy']);



Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/kelas', KelasController::class);

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});