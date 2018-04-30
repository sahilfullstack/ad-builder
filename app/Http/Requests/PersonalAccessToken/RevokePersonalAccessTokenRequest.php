<?php

namespace App\Http\Requests\PersonalAccessToken;

use Illuminate\Foundation\Http\FormRequest;

class RevokePersonalAccessTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('revoke', $this->instance()->route('personal_access_token'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
