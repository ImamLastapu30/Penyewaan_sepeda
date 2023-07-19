<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DealerController;
use App\Http\Controllers\Api\MerkController;
use App\Http\Controllers\Api\SepedaController;
use App\Http\Controllers\Api\AuthController;

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
Route::get('dealer', [DealerController::class, 'index']);
Route::get('dealer/{id}', [DealerController::class, 'show']);

Route::get('merk', [MerkController::class, 'index']);
Route::get('merk/{id}', [MerkController::class, 'show']);

Route::get('sepeda', [SepedaController::class, 'index']);
Route::get('sepeda/{id}', [SepedaController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('dealer', [DealerController::class, 'store']);
    Route::patch('dealer/{id}', [DealerController::class, 'update']);
    Route::delete('dealer/{id}', [DealerController::class, 'destroy']);

    Route::post('merk', [MerkController::class, 'store']);
    Route::patch('merk/{id}', [MerkController::class, 'update']);
    Route::delete('merk/{id}', [MerkController::class, 'destroy']);

    Route::post('sepeda', [SepedaController::class, 'store']);
    Route::patch('sepeda/{id}', [SepedaController::class, 'update']);
    Route::delete('sepeda/{id}', [SepedaController::class, 'destroy']);


    Route::post('sewa/{id}', [SepedaController::class, 'sewa']);
    // Route::resource('dealer', DealerController::class);
});

// Route::resource('merk', MerkController::class);
// Route::resource('sepeda', SepedaController::class);

Route::post('/register', [AuthController::class, 'registrasi']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
