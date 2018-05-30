<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Subscription;

class CreateSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', Subscription::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'layout_id'        => 'required|exists:layouts,id',
            'expiring_at'      => 'required',
            'allow_videos'     => 'required',
            'allow_hover'      => 'required',
            'allow_popout'     => 'required',
        ];
    }
}
