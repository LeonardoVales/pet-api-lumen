<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class Especie
{
    private string $nome;
    private const ESPECIES_VALIDAS = ['Gato', 'Cachorro'];

    public function __construct(string $nome)
    {
        if (!in_array($nome, self::ESPECIES_VALIDAS)) {
            throw new InvalidArgumentException('Espécie inválida', 500);
        }

        $this->nome = $nome;
    }

    public function __toString(): string
    {
        return $this->nome;
    }
}