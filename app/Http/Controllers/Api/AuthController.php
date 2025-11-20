<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ApiResource;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    /**
     * @OA\Post(
     *     path="/auth/register",
     *     tags={"Auth"},
     *     summary="",
     *     description="auth register",
     *     operationId="auth_register",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="name",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string"
     *                  ),
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="OK",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              example={
     *                  "success"=true,
     *                  "message"="File uploaded successfully",
     *                  "data"={}
     *              }
     *         )
     *     )
     * )
     */
    public function register(Request $request)
    {
        // response
        $message = '';
        $data = [];
        $metadata = [];

        //set validation
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6'
        ]);

        //if validation fails
        if ($validator->fails()) {
            $message = 'Validation failed';
            $data = $validator->errors();
            return new ApiResource(false, 422, $message, $data, $metadata);
        }

        //create user
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'username'  => explode('@', $request->email)[0],
            'picture'   => 'noimage.jpg',
            'user_level_id'  => 2,
            'email_verified_token' => sha1($request->email . '~' . time())
        ]);

        //return response JSON user is created
        if($user) {
            // send email
            $to = "akatgelar@gmail.com";
            $subject = "Registration Smart City App";
            $link = env('APP_URL') . '/api/auth/verify/' . sha1($request->email . '~' . time());
            $payload = "<html>";
            $payload .= "<p>Hallo, {$to}</p>";
            $payload .= "<p>Selamat datang di Smart City App.</p>";
            $payload .= "<p>Klik <a href='{$link}'>di sini</a> untuk verifikasi email anda.</p>";
            $payload .= '</html>';
            $result =  \App\Helpers\AppHelper::instance()->sendMail($to, $subject, $payload);

            // response
            $message = 'Registration success, check email for activation';
            $data = $user;
            return new ApiResource(true, 201, $message, $data, $metadata);
        } else {
            $message = 'Registration failed';
            return new ApiResource(false, 409, $message, $data, $metadata);
        }
    }

    /**
     * @OA\Get(
     *     path="/auth/verify/{token}",
     *     tags={"Auth"},
     *     summary="",
     *     description="auth verify",
     *     operationId="auth_verify",
     *     @OA\Parameter(
     *          name="token",
     *          description="token",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="OK",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              example={
     *                  "success"=true,
     *                  "message"="File uploaded successfully",
     *                  "data"={}
     *              }
     *         )
     *     )
     * )
     */
    public function verify($token)
    {
        if($token) {
            // get data where token
            $user = User::where('email_verified_token', $token)->first();
            if($user) {
                // update status active
                $user->is_active = 1;
                $user->email_verified_at = now();
                $user->save();

                // response
                $html = "Your e-mail is verified. You can now login.";
                return response($html, 200)->header('Content-Type', 'text/html');
            } else {
                $html = "Token or email not found in database";
                return response($html, 401)->header('Content-Type', 'text/html');
            }
        } else {
            $html = "Token param not found.";
            return response($html, 401)->header('Content-Type', 'text/html');
        }
    }

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"Auth"},
     *     summary="",
     *     description="auth login",
     *     operationId="auth_login",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="email",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string"
     *                  ),
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="OK",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              example={
     *                  "success"=true,
     *                  "message"="File uploaded successfully",
     *                  "data"={}
     *              }
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        // response
        $message = '';
        $data = [];
        $metadata = [];

        //set validation
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            $message = 'Validation failed';
            $data = $validator->errors();
            return new ApiResource(false, 422, $message, $data, $metadata);
        }

        //get credentials from request
        $credentials = $request->only('email', 'password');
        $user = User::select('users.*', 'user_levels.name as user_level_name')
            ->join('user_levels', 'users.user_level_id', '=', 'user_levels.id')
            ->where('email', $credentials['email'])
            ->first();
        if ($user) {
            $user_array = $user->toArray();
            $user_object = (object) $user_array;

            if ($user_object && $user_object->is_active) {

                $claims = [
                    'id' => $user_object->id,
                    'name' => $user_object->name,
                    'email' => $user_object->email,
                    'username' => $user_object->username,
                    'user_level_id' => $user_object->user_level_id,
                    'user_level_name' => $user_object->user_level_name,
                ];

                $token = JWTAuth::claims($claims)->attempt($credentials);

                // if auth failed
                if($token) {
                    // update last_login
                    $user->last_login = now();
                    $user->save();

                    $message = 'Login success';
                    $data = [];
                    $data['user'] = $user;
                    $data['token'] = $token;
                    return new ApiResource(true, 200, $message, $data, $metadata);
                } else {
                    $message = 'Login failed, Email or Password missmatch';
                    return new ApiResource(false, 401, $message, $data, $metadata);
                }
            } else {
                $message = 'Login failed, Account not active';
                return new ApiResource(false, 401, $message, $data, $metadata);
            }
        } else {
            $message = 'Login failed, Email not found';
            return new ApiResource(false, 401, $message, $data, $metadata);
        }
    }
}
