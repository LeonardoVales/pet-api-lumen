<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class Telefone
{
    private string $telefone;
    private const REGEX = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';

    public function __construct(string $telefone)
    {
        if (preg_match(self::REGEX, $telefone) == false) {
            throw new InvalidArgumentException('Telefone inválido', 500);
        }
        
        $this->telefone = $telefone;
    }
    
    public function __toString(): string
    {
        return $this->telefone;
    }
}