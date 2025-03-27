<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('upload-excel-file', [FileUploadController::class, 'uploadFile']);
Route::get('get-mobile-numbers', [FileUploadController::class, 'getMobileNumbers']);
