<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/{any?}', function () {
    return view('template');
// })->where('vue_capture', '[\/\w\.-]*');
})->where('any', '.*');
