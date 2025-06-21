<?php

use App\Http\Controllers\ApiQRcodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
$hasUrl = bcrypt(date('d-m-Y H:m:i'));
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

// Route::get('ksit/qrcode/'.$hasUrl.'{id}', [ApiQRcodeController::class, 'index'])->name('api.generateqr');
// Route::get('ksit/qrcode/{id}', [ApiQRcodeController::class, 'index'])->name('api.generateqr');
