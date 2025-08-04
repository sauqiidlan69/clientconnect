<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPhoneNumber implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^\+?\d{7,15}$/', $value);
    }

    public function message(): string
    {
        return 'The :attribute must be a valid phone number.';
    }
}
