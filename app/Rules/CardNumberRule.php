<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CardNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $sum = 0;
        for ($i = 0; $i < strlen($value); $i++) {
            if (($i + 1) % 2 == 0) {
                $result = intval($value[$i]) * 1;
            } else {
                if (intval($value[$i]) * 2 > 9) {
                    $result = intval($value[$i]) * 2 - 9;
                } else {
                    $result = intval($value[$i]) * 2;
                }
            }
            $sum += $result;
        }

        if ($sum % 10 != 0) {
            $fail("The $attribute is not valid format");
        }
    }
}
