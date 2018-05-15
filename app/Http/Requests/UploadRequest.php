<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'file' => 'required|file|image',
            'file' => 'required|file|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,image/jpeg,image/png,audio/mp3,audio/mpeg,application/octet-stream',
            'type' => 'required_if:file,application/octet-stream'
        ];
    }
}
