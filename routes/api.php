<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Mail;

Route::get("/test-me", function () {
    $message = 'Hello from Laravel!';
    $data = [];
    $temp = [];
    $temp['key'] = 'value';
    array_push($data, $temp);

    $metadata = [];
    $metadata['page'] = 1;
    return new ApiResource(true, 200, $message, $data, $metadata);
});

Route::get('/send-email',function(){
    try {
        $to = "akatgelar@gmail.com";
        $html = "<html>";
        $html = "<h3>Hallo, {$to}</h3>";
        $html = "<h5>Terima kasih telah registrasi di Smart City App</h5>";
        $html .= '</html>';
        Mail::send([], [], function ($message) use ($to, $html) {
            $message->to($to)
                ->subject('Registration Smart City App')
                ->html($html);
        });

        $message = 'Email send success';
        $data = [];
        $metadata = [];
        return new ApiResource(true, 200, $message, $data, $metadata);
    } catch (Exception $ex) {
        print_r($ex);

        $message = $ex;
        $data = [];
        $metadata = [];
        return new ApiResource(false, 500, $message, $data, $metadata);
    }
});



Route::post('/auth/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/auth/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('/auth/verify/{token}', [App\Http\Controllers\Api\AuthController::class, 'verify']);

Route::middleware([])->group(function () {
    Route::apiResource('user', App\Http\Controllers\Api\UserController::class);
    Route::apiResource('user_level', App\Http\Controllers\Api\UserLevelController::class);
    Route::apiResource('setting', App\Http\Controllers\Api\SettingController::class);
    Route::post('setting/bulk', [App\Http\Controllers\Api\SettingController::class, 'bulk']);

    Route::get('/minio/get', [App\Http\Controllers\Api\MinioController::class, 'get'])
        // ->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ;

    Route::post('/minio/upload', [App\Http\Controllers\Api\MinioController::class, 'upload'])
        // ->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ;
});
