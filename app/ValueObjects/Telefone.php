<?php

namespace App\ValueObjects;

class Telefone
{
    private string $telefone;

    public function __construct(string $telefone)
    {
        $this->telefone = $telefone;
    }
    
    public function __toString(): string
    {
        return $this->telefone;
    }
}