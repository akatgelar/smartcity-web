<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/minio/upload', [App\Http\Controllers\MinioController::class, 'upload'])
    ->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]
);

Route::get('/{any?}', function () {
    return view('template');
// })->where('vue_capture', '[\/\w\.-]*');
})->where('any', '.*');
