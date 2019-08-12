<?php


namespace Melhorenvio\ValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;


class Cpf implements Rule
{
    protected $invalidCpfs;

    public $allowMask;

    public function __construct($allowMask = true)
    {
        $this->allowMask = $allowMask;

        $this->invalidCpfs = [
            '00000000000',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999',
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

        if (!($value && mb_strlen($value) === 11)) {
            return false;
        }

        // Check for invalid cpfs.
        if (in_array($value, $this->invalidCpfs)) {
            return false;
        }

        for ($i = 0, $j = 10, $sum = 0; $i < 9; $i++, $j--) {
            $sum += $value{$i} * $j;
        }

        $mod = $sum % 11;

        if ($value{9} != ($mod < 2 ? 0 : 11 - $mod)) {
            return false;
        }

        for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--) {
            $sum += $value{$i} * $j;
        }

        $mod = $sum % 11;

        return $value{10} == ($mod < 2 ? 0 : 11 - $mod);
    }

    public function message(): string
    {
        return __('meValidationRules::messages.cpf');
    }
}
