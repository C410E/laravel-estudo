<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('students', [ApiController::class, 'getAllStudents']);
Route::get('students/{id}', [ApiController::class, 'getStudent']);
Route::post('students', [ApiController::class, 'createStudent']);
Route::put('students/{id}', [ApiController::class, 'updateStudent']);
Route::delete('students/{id}',[ApiController::class, 'deleteStudent']);

Route::get('produtos', [ProductsController::class, 'getAllProducts']);
Route::post('produtos', [ProductsController::class, 'createProduct']);
Route::put('produtos/{id}', [ProductsController::class, 'updateProduct']);
Route::get('retirar-do-estoque/{id}', [ProductsController::class, 'decreaseStock']);