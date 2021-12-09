<?php

namespace App\ApiV1\Nab\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNabRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_balance' => 'required|numeric'
        ];
    }
}