<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;
use App\Services\FileUploader\FileUploader;
use App\Services\FileUploader\Exceptions as FileUploaderExceptions;

class UploadController extends Controller
{

    public function upload(UploadRequest $request, FileUploader $fileUploader)
    {
        $name = str_random(31) . '.' . time(); // some random name
        
        try {
            $url = $fileUploader->name($name)
                ->file($request->input('file'))
                ->upload();
                
        } catch (FileUploaderExceptions\InvalidInputException $e) {
            throw new Exceptions\InvalidInputException($e->getMessage());
        } catch (Exception $e) {
            throw new Exceptions\InternalException($e->getMessage());
        }

        return response(['data' => ['url' => $url]], 200);
    }
}
