<?php

namespace App\ApiV1\Transaction\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|numeric|exists:users,id',
            'amount_rupiah' => 'required|numeric'
        ];
    }
}