<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUnitRequest extends FormRequest
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
            'name' => 'required',
            'template_id' => 'required|exists:templates,id',
            'components' => 'required'
            // 'template_id' => [
            //     'required',
            //     Rule::exists('templates')->where(function($query) {
            //         $query->whereNull('deleted_at');
            //     }),
            // ]
        ];
    }
}
