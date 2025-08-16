<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ApiResource;

class MinioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/minio/get",
     *     tags={"Minio"},
     *     summary="",
     *     description="minio get",
     *     operationId="minio_get",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="path",
     *          description="path value is string. ex : ?path=xxx.jpg",
     *          required=false,
     *          in="query",
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
     *                  "message"="Get Data Successfull",
     *                  "data"={}
     *              }
     *         )
     *     )
     * )
     */
    public function get(Request $request)
    {
        $path = $request->has('path') ? $request->get('path') : '';
        $expirationTime = now()->addMinutes(5);
        $temporaryUrl = Storage::disk('minio')->temporaryUrl($path, $expirationTime);

        $message = 'Success get data.';
        $data = $temporaryUrl;
        $metadata = [];

        return new ApiResource(200, true, $message, $data, $metadata);

    }

    /**
     * @OA\Post(
     *     path="/minio/upload",
     *     tags={"Minio"},
     *     summary="",
     *     description="monio upload",
     *     operationId="monio_upload",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="name",
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
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {

            // validation
            $request->validate([
                'file' => 'required|file|max:2048',
            ]);

            $file = $request->file('file');
            $fileName = date('YmdHis') . '_' . $file->getClientOriginalName();
            $path = Storage::disk('minio')->putFileAs('', $file, $fileName);

            $message = 'File uploaded successfully';
            $data = [];
            $data['original_name'] = $file->getClientOriginalName();
            $data['mime_type'] = $file->getClientMimeType();
            $data['path'] = $path;
            $metadata = [];

            return new ApiResource(200, true, $message, $data, $metadata);

        } else {
            $message = 'No file uploaded';
            $data = [];
            $metadata = [];

            return new ApiResource(400, false, $message, $data, $metadata);
        }

        $message = 'Internal Error';
        $data = [];
        $metadata = [];

        return new ApiResource(500, false, $message, $data, $metadata);
    }
}
