<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;
use App\Services\FileUploader\FileUploader;
use App\Services\FileUploader\Exceptions as FileUploaderExceptions;
use Storage;

class UploadController extends Controller
{
    public function upload(UploadRequest $request, FileUploader $fileUploader)
    {
        try {
            if($request->file->isValid())
            {
                if($request->file->getMimeType() == "application/octet-stream")
                {
                    $url = Storage::url($request->file->storeAs(config('uploads.folder'), $request->get("file_name")));
                }
                else
                {                    
                    $url = Storage::url($request->file->store(config('uploads.folder')));
                }
            }
            else
            {
                throw new Exceptions\InternalException('File was not uploaded properly');    
            }
        } catch (Exception $e) {
            throw new Exceptions\InternalException($e->getMessage());
        }

        return response(['data' => ['url' => $url]], 200);
    }
}
