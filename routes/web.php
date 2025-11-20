<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any?}', function () {
    $data['setting'] = \App\Helpers\AppHelper::instance()->requestApiSetting();
    return view('template', $data);
})->where('any', '^(?!api).*');
