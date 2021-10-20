<?php

use App\ValueObjects\Telefone;

class TelefoneTest extends TestCase
{
    public function test_deve_retornar_uma_excecao_se_o_telefone_for_invalido()
    {
        $this->expectException(InvalidArgumentException::class);

        new Telefone('4564');
    }
}