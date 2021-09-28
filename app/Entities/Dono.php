<?php

namespace App\Entities;

use App\Entities\EntitieInterface;
use App\ValueObjects\Telefone;

class Dono implements EntitieInterface
{
    private string $id;
    private string $nome;
    private Telefone $telefone;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

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