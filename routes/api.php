<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\EstudianteController as EstudianteV1;
use App\Http\Controllers\Api\V2\EstudianteController as EstudianteV2;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello-world', function () {
    return ["message" => "Hello World! desde Laravel API"];
});

// Version 1 de la API
Route::prefix('v1')->group(function () {
    Route::apiResource('estudiantes', EstudianteV1::class);
});

// Version 2 de la API
Route::prefix('v2')->group(function () {
    Route::apiResource('estudiantes', EstudianteV2::class);
});
