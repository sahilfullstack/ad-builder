<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * axios.post(
 *      '/api/views',
 *      {unit_id: 1, viewed_at: 1525434243, duration: 33, category_id: 12, landing_from: 'category_page'},
 *      {headers: {'content-type': 'application/vnd.mesa.v1+json'}}
 * );
 */
class StoreViewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role->slug == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unit_id' => 'required|exists:units,id',
            'viewed_at' => 'required',
            'duration' => 'required|integer',
            'category_id' => 'required',
            'landing_from' => 'required'
        ];
    }
}
