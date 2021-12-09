<?php

namespace App\ApiV1\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|numeric',
            'limit' => 'nullable|numeric',
        ];
    }
}