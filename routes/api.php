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
Route::get('/mapelGuru', [MapelController::class, 'getMapelGuru'])->name('mapel.guru');
Route::post('/addMapelGuru', [MapelController::class, 'addMapelGuru'])->name('mapel.gurutambah');

Route::resource('/siswa', SiswaController::class);
Route::get('/getkelas/{id}', [SiswaController::class, 'getKelasbySiswa']);
Route::get('/getSiswa', [SiswaController::class, 'getSiswaByID']);
Route::post('/importSiswa', [SiswaController::class, 'importSiswa']);

Route::resource('/guru', GuruController::class);

Route::resource('/ujian', UjianController::class);
Route::get('/getUjianSiswa', [UjianController::class, 'getUjianSiswa'])->name('ujian.bysiswa');
Route::get('/getUjianGuru', [UjianController::class, 'getUjianGuru'])->name('ujian.byguru');

Route::resource('/soal', SoalController::class);
Route::get('/getSoalByUjian/{id}', [SoalController::class, 'getSoalByUjian'])->name('soal.ujian');
Route::get('/getSoalById/{id}', [SoalController::class, 'getSoalById'])->name('soal.id');
Route::post('/importSoal', [SoalController::class, 'importSoal'])->name('soal.import');

Route::resource('/nilai', NilaiController::class);
Route::get('/nilaiSiswa/{id}',[NilaiController::class,'getNilaibySiswa'])->name('nilai.bysiswa');
Route::get('/getNilai/{id}',[NilaiController::class,'getNilai'])->name('nilai.byid');
Route::get('/getNilaiSiswa',[NilaiController::class, 'getNilaiSiswa'])->name('nilai.siswa');
Route::get('/getNilaiUjian/{id}', [NilaiController::class, 'getNilaiUjian'])->name('nilai.ujian');
Route::get('/addNilai',[NilaiController::class, 'addNilai'])->name('nilai.tambah');
Route::put('/updNilai/{id}',[NilaiController::class, 'updNilai'])->name('nilai.update');
Route::get('/cekNilai',[NilaiController::class, 'cekNilai'])->name('nilai.cek');

Route::resource('/jawaban', JawabanController::class);
Route::get('/cekJawaban', [JawabanController::class, 'cekJawaban'])->name('jawaban.cek');

Route::get('/datasiswa/{id}',[NilaiController::class,'getSiswa']);
Route::get('/datasiswa',[NilaiController::class,'getSiswaAll']);

Route::resource('/admin', AdminController::class);


