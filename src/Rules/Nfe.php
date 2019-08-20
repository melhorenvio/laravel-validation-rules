<?php


namespace Melhorenvio\ValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;


class Nfe implements Rule
{
    public $allowMask;

    public function __construct($allowMask = true)
    {
        $this->allowMask = $allowMask;
    }

    public function passes($attribute, $value): bool
    {
        if (!$value) {
            return true;
        }

        if ($this->allowMask) {
            $value = preg_replace('/\D/', '', $value);
        }

        if (!($value && mb_strlen($value) === 44) || mb_substr($value, 0, 2) === '00') {
            return false;
        }

        $sum = 0;

        $weight = 2;

        for ($i = mb_strlen($value) - 2; $i >= 0; $i--) {
            $sum += $value{$i} * $weight;
            $weight = $weight < 9 ? $weight + 1 : 2;
        }

        $digit = 11 - ($sum % 11);

        if ($digit > 9) {
            $digit = 0;
        }

        return $digit === (int) mb_substr($value, 43, 1);
    }

    public function message(): string
    {
        return __('meValidationRules::messages.nfe');
    }
}
