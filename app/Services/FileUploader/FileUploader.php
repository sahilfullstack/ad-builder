<?php

namespace App\Services\FileUploader;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\UploadedFile;
use App\Services\FileUploader\Exceptions;
use Validator, Image;

class FileUploader {

    /**
     * String: name of the file.
     */ 
    protected $name;

    /**
     * Instance of Image
     */
    protected $file;

    /**
     * String: the folder in which respective file will be stored.
     */
    protected $folder;

    public function __construct()
    {
        $this->folder = config('uploads.path');
    }

    public function name(String $name)
    {
        $this->name = $name;

        return $this;
    }

    public function file($file)
    {
        $this->file = $file;
        
        return $this;
    }

    public function upload()
    {
        $this->validate();
        
        $path = $this->prepareFilePath();
        
        Storage::put($path, $this->getFileContent());
        
        return Storage::url($path);
    }

    private function getFileContent()
    {
        return (string) $this->file->encode();
    }

    private function prepareFilePath()
    {
        list($fileDirectory, $fileName) = $this->prepareFileData();

        $fileDirectory = $fileDirectory != '' 
                            ? $fileDirectory . $this->folder
                            : $this->folder;
        
        return "$fileDirectory/$fileName";
    }

    private function validate() 
    {
        $validator = Validator::make($this->getData(), $this->getRules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    private function getData()
    {   
        return [
            'name' => $this->name,
            'file' => $this->file
        ];
    }

    private function getRules()
    {
        return [
            'name' => 'required',
            'file' => 'required'
        ];
    }

    private function prepareFileData()
    {
        $explodedName = explode('/', $this->name);
        $extension = image_extension($this->file);

        $fileDirectory = '';

        /**
         * If only name is provided without path
         */
        if(($count = count($explodedName)) == 1)
        {
            $fileName = str_slug($explodedName[0]). ".$extension";
        }
        /**
         * If only name is provided with path
         */
        else 
        {
            $fileName = str_slug($explodedName[$count-1]). ".$extension";

            $fileDirectory = '';
            foreach (array_except($explodedName, [$count-1]) as $key => $value) 
            {
                $fileDirectory .= trim($value). '/';
            }
        }

        return [$fileDirectory, $fileName];
    }
}