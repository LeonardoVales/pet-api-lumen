<?php

use App\ValueObjects\Especie;

class EspecieTest extends TestCase
{
    public function test_especie_valida()
    {
        $this->expectException(InvalidArgumentException::class);

        new Especie('Nelore');
    }
}