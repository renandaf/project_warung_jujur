<?php

namespace App\Http\Controllers;


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



Route::get('/dagangan', [DaganganController::class, 'index']);
Route::get('/preorder', [PreorderController::class, 'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dagangan/{id}', [DaganganController::class, 'show']);
Route::get('/preorder/{id}', [PreorderController::class, 'show']);
Route::get('/all/dagangan', [DaganganController::class, 'showAll']);
Route::get('/all/preorder', [PreorderController::class, 'showAll']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::put('/dagangan/{dagangan}', [DaganganController::class, 'update']);
    Route::put('/edit', [AuthController::class, 'edit']);
    Route::put('/preorder/{preorder}', [PreorderController::class, 'update']);
    Route::delete('/dagangan/{id}', [DaganganController::class, 'destroy']);
    Route::delete('/preorder/{id}', [PreorderController::class, 'destroy']);
    Route::put('/dagangan/status/{dagangan}', [DaganganController::class, 'updateStatus']);
    Route::put('/preorder/status/{preorder}', [PreorderController::class, 'updateStatus']);
    Route::post('/dagangan', [DaganganController::class, 'store']);
    Route::post('/preorder', [PreorderController::class, 'store']);
    Route::get('/user/dagangan', [DaganganController::class, 'showPemilik']);
    Route::get('/user/preorder', [PreorderController::class, 'showPemilik']);
});
