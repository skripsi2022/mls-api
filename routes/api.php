<?php

// use App\Http\Controllers\API\AuthController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UjianController;
use App\Models\Nilai;
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
Route::get('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Protecting Routes
// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::get('/profile', function (Request $request) {
//         return auth()->user();
//     });


//     // API route for logout user
//     Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
// });

Route::resource('/jurusan', JurusanController::class);
Route::resource('/kelas', KelasController::class);

Route::resource('/mapel', MapelController::class);
Route::get('/mapelGuru', [MapelController::class, 'getMapelGuru']);
Route::post('/addMapelGuru', [MapelController::class, 'addMapelGuru']);

Route::resource('/siswa', SiswaController::class);
Route::get('/getkelas/{id}', [SiswaController::class, 'getKelasbySiswa']);
Route::get('/getSiswa', [SiswaController::class, 'getSiswaByID']);


Route::resource('/guru', GuruController::class);

Route::resource('/ujian', UjianController::class);
Route::get('/getUjianSiswa', [UjianController::class, 'getUjianSiswa']);
Route::get('/getUjianGuru', [UjianController::class, 'getUjianGuru']);

Route::resource('/soal', SoalController::class);
Route::get('/getSoalByUjian/{id}', [SoalController::class, 'getSoalByUjian']);
Route::get('/getSoalById/{id}', [SoalController::class, 'getSoalById']);

Route::resource('/nilai', NilaiController::class);
Route::get('/nilaiSiswa/{id}',[NilaiController::class,'getNilaibySiswa']);
Route::get('/getNilaiSiswa',[NilaiController::class, 'getNilaiSiswa']);
Route::get('/getNilaiGuru',[NilaiController::class, 'getNilaiGuru']);
Route::get('/addNilai',[NilaiController::class, 'addNilai']);

Route::get('/datasiswa/{id}',[NilaiController::class,'getSiswa']);
Route::get('/datasiswa',[NilaiController::class,'getSiswaAll']);

Route::resource('/admin', AdminController::class);
Route::resource('/soal', SoalController::class);

Route::resource('/jawaban',JawabanController::class);
Route::get('/cekJawaban', [JawabanController::class, 'cekJawaban']);
