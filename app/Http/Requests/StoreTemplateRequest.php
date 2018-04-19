<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Template;

class StoreTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', Template::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:ad,page',
            'layout_id' => 'sometimes|nullable|exists:layouts,id',
            'name' => 'required',
            'renderer' => 'required',
            'components.*.name' => 'required|distinct',
            'components.*.type' => 'required|in:image,text,video',
        ];
    }
}
