<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/test-me", function () {
    return 'Hello from Laravel!';
});
