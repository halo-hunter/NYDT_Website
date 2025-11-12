<?php

namespace App\Rules\Crm;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BccValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value != '') {
            $arr = explode(',', $value);
            foreach ($arr as $item) {
                if (!filter_var($item, FILTER_VALIDATE_EMAIL)) {
                    $fail('Enter a valid e-mail address.');
                }
            }
        }
    }
}
