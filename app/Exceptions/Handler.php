<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;
use Illuminate\Support\Facades\Auth;

class Handler
{

    public function customApiResponse($exception)
    {
        // dd($exception);
        // dd([
        //     'auth'       => $exception instanceof \Illuminate\Auth\AuthenticationException,
        //     'validation' => $exception instanceof \Illuminate\Validation\ValidationException,
        //     'notFound'   => $exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
        // ]);
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else if (!Auth::guard('api')->check()) {
            $statusCode = 401;
        } else if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $statusCode = 422;
        } else if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $statusCode = 404;
        } else {
            $statusCode = 500;
        }

        $response = [
            'status' => false,
            'status_code' => $statusCode,
            'message' => 'Unknown error',
            'data' => [],
            'metadata' => [
                // 'timestamp' => now()->toISOString(),
            ],
        ];

        switch ($statusCode) {
            case 302:
            case 401:
                $response['message'] = 'Unauthorized';
                $statusCode = 401;
                break;
            case 403:
                $response['message'] = 'Forbidden';
                break;
            case 404:
                $response['message'] = 'Not Found';
                break;
            case 405:
                $response['message'] = 'Method Not Allowed';
                break;
            case 422:
                $response['message'] = $exception->getMessage() ?: 'Validation Error';
                $response['data'] = $exception->errors() ?? [];
                break;
            case 500:
                $response['message'] = app()->environment('local', 'testing')
                    ? 'Internal server error: '.$exception->getMessage()
                    : 'Internal server error';
                break;
        }

        return response()->json($response, $statusCode);
    }
}
