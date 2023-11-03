<?php

namespace Melhorenvio\ValidationRules\Tests;

use Melhorenvio\ValidationRules\Rules\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideInvalidCpfs
     */
    public function test_with_invalid_cpfs(string $cpf)
    {
        $rule = new Cpf();

        $this->assertFalse($rule->passes('cpf', $cpf));
    }

    /**
     * @test
     * @dataProvider provideValidCpfs
     */
    public function test_with_valid_cpfs(string $cpf)
    {
        $rule = new Cpf();

        $this->assertTrue($rule->passes('cpf', $cpf));
    }

    public function test_with_empty_cpf()
    {
        $rule = new Cpf();

        $this->assertFalse($rule->passes('cpf', ''));
        $this->assertFalse($rule->passes('cpf', null));
    }

    public function test_with_zeroed_cpf()
    {
        $rule = new Cpf();

        $this->assertFalse($rule->passes('cpf', '0'));
        $this->assertFalse($rule->passes('cpf', 0));
    }

    public static function provideInvalidCpfs(): array
    {
        return [
            ['00000000000'],
            ['11111111111'],
            ['22222222222'],
            ['33333333333'],
            ['44444444444'],
            ['55555555555'],
            ['66666666666'],
            ['77777777777'],
            ['88888888888'],
            ['99999999999'],
            ['000.000.000-00'],
            ['111.111.111-11'],
            ['222.222.222-22'],
            ['333.333.333-33'],
            ['444.444.444-44'],
            ['555.555.555-55'],
            ['666.666.666-66'],
            ['777.777.777-77'],
            ['888.888.888-88'],
            ['999.999.999-99'],
        ];
    }

    public static function provideValidCpfs(): array
    {
        return [
            ['322.282.090-23'],
            ['024.278.590-52'],
            ['014.533.750-23'],
            ['335.203.900-35'],
            ['108.810.610-26'],
            ['97005733037'],
            ['86939244000'],
            ['62747195040'],
            ['75726024010'],
            ['45061931050'],
        ];
    }
}
