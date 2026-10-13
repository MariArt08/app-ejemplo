<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello-world', function () {
    return ["message" => "Hello World! desde Laravel API"];
});

Route::apiResource('estudiantes', EstudianteController::class);
