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

    public function getNome(): string
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
        $donoArray = get_object_vars($this);
        unset($donoArray['telefone']);
        
        return array_merge(
            ['telefone' => $this->getTelefone()],
            $donoArray
        );
    }

}