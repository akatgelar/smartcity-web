<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MinioController extends Controller
{

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

            // Optional: Store the file path in your database
            // $filePath = Storage::disk('s3')->url($path);
            // YourModel::create(['file_path' => $filePath]);

            return response()->json(['message' => 'File uploaded successfully', 'path' => $path], 200);

        } else {
            return response()->json(['message' => 'No file uploaded'], 400);
        }

        return response()->json(['message' => 'Internal Error'], 500);
    }
}
