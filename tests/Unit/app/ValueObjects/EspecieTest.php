<?php

use App\ValueObjects\Especie;

class EspecieTest extends TestCase
{
    public function test_especie_valida()
    {
        $this->expectException(InvalidArgumentException::class);

        new Especie('Nelore');
    }

    public function test_deve_ser_string()
    {
        $especie = new Especie('Gato');

        $this->assertIsString($especie->__toString());        
    }
}