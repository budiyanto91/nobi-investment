<?php

namespace App\ApiV1\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'username' => 'required|string|unique:users,username|max:191',
        ];
    }
}