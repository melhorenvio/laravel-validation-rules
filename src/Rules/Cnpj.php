<?php


namespace Melhorenvio\ValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;


class Cnpj implements Rule
{
    protected $invalidCnpjs;

    public $allowMask;

    public function __construct($allowMask = true)
    {
        $this->allowMask = $allowMask;

        $this->invalidCnpjs = [
            '00000000000000',
            '11111111111111',
            '22222222222222',
            '33333333333333',
            '44444444444444',
            '55555555555555',
            '66666666666666',
            '77777777777777',
            '88888888888888',
            '99999999999999',
        ];
    }

    public function passes($attribute, $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if ($this->allowMask) {
            $value = preg_replace('/\D/', '', $value);
        }

        if (!($value && mb_strlen($value) === 14)) {
            return false;
        }

        if (in_array($value, $this->invalidCnpjs)) {
            return false;
        }

        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $mod = $sum % 11;

        if ($value[12] != ($mod < 2 ? 0 : 11 - $mod)) {
            return false;
        }

        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $mod = $sum % 11;

        return $value[13] == ($mod < 2 ? 0 : 11 - $mod);
    }

    public function message(): string
    {
        return __('meValidationRules::messages.cnpj');
    }
}
