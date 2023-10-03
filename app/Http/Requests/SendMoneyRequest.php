<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMoneyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'source_card_number' => 'required',
            'destination_card_number' => 'required',
            'amount' => 'required|numeric|min:0',
        ];
    }
}
