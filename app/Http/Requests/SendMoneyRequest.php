<?php

namespace App\Http\Requests;

use App\Rules\CardNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class SendMoneyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'source_card_number' => ['required', 'digits:16', new CardNumberRule],
            'destination_card_number' => ['required', 'digits:16', new CardNumberRule],
            'amount' => 'required|numeric|min:1000|max:50000000',
        ];
    }
}
