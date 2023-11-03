<?php

namespace Melhorenvio\ValidationRules\Tests;

use Melhorenvio\ValidationRules\Rules\Cnpj;
use PHPUnit\Framework\TestCase;

class CnpjTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideInvalidCnpjs
     */
    public function test_with_invalid_cnpjs(string $cnpj)
    {
        $rule = new Cnpj();

        $this->assertFalse($rule->passes('cnpj', $cnpj));
    }

    /**
     * @test
     * @dataProvider provideValidCnpjs
     */
    public function test_with_valid_cnpjs(string $cnpj)
    {
        $rule = new Cnpj();

        $this->assertTrue($rule->passes('cnpj', $cnpj));
    }

    public function test_with_empty_cnpj()
    {
        $rule = new Cnpj();

        $this->assertFalse($rule->passes('cnpj', ''));
        $this->assertFalse($rule->passes('cnpj', null));
    }

    public function test_with_zeroed_cnpj()
    {
        $rule = new Cnpj();

        $this->assertFalse($rule->passes('cnpj', '0'));
        $this->assertFalse($rule->passes('cnpj', 0));
    }

    public static function provideInvalidCnpjs(): array
    {
        return [
            ['00000000000000'],
            ['11111111111111'],
            ['22222222222222'],
            ['33333333333333'],
            ['44444444444444'],
            ['55555555555555'],
            ['66666666666666'],
            ['77777777777777'],
            ['88888888888888'],
            ['99999999999999'],
            ['00.000.000/0000-00'],
            ['11.111.111/1111-11'],
            ['22.222.222/2222-22'],
            ['33.333.333/3333-33'],
            ['44.444.444/4444-44'],
            ['55.555.555/5555-55'],
            ['66.666.666/6666-66'],
            ['77.777.777/7777-77'],
            ['88.888.888/8888-88'],
            ['99.999.999/9999-99'],
        ];
    }

    public static function provideValidCnpjs(): array
    {
        return [
            ['05.495.723/0001-22'],
            ['04.307.064/0001-90'],
            ['25.394.311/0001-03'],
            ['05495723000122'],
            ['04307064000190'],
            ['25394311000103'],
        ];
    }
}
