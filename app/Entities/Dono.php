<?php

namespace App\Entities;

use App\Entities\EntitieInterface;
use App\ValueObjects\Telefone;

class Dono extends EntitieAbstract implements EntitieInterface
{
    private string $nome;
    private Telefone $telefone;

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setTelefone(Telefone $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

}