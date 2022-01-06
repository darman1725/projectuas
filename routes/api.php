<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SkripsiController;
use App\Http\Controllers\API\SemproController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register-mhs', [AuthController::class, 'registerMahasiswa']);
Route::post('register-dsn', [AuthController::class, 'registerDosen']);
Route::post('register-adm', [AuthController::class, 'registerAdmin']);
Route::post('login', [AuthController::class, 'login']);
Route::post('daftar-skripsi', [SkripsiController::class, 'daftarSkripsi']);
Route::post('daftar-sempro', [SemproController::class, 'daftarSempro']);
Route::get('jadwal-sempro', [SemproController::class, 'jadwalSempro']);
Route::get('jadwal-skripsi', [SkripsiController::class, 'jadwalSkripsi']);
Route::get('skripsiHariIni', [SkripsiController::class, 'SkripsiFilterHariIni']);
Route::get('skripsiBesok', [SkripsiController::class, 'SkripsiFilterBesok']);
Route::get('SemproHariIni', [SkripsiController::class, 'SemproFilterHariIni']);
Route::get('SemproBesok', [SkripsiController::class, 'SemproFilterBesok']);
Route::put('editPass/{id}', [AuthController::class, 'editPassword']);
Route::get('user/{id}', [AuthController::class, 'singleUser']);
Route::resource('destroySkripsi', SkripsiController::class);
Route::resource('destroySempro', SemproController::class);
