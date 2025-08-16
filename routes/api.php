<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ApiResource;

Route::get("/test-me", function () {
    $message = 'Hello from Laravel!';
    $data = [];
    $temp = [];
    $temp['key'] = 'value';
    array_push($data, $temp);

    $metadata = [];
    $metadata['page'] = 1;
    return new ApiResource(200, true, $message, $data, $metadata);
});

Route::get('/minio/get', [App\Http\Controllers\MinioController::class, 'get'])
    // ->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
;

Route::post('/minio/upload', [App\Http\Controllers\MinioController::class, 'upload'])
    // ->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
;
