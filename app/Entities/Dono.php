<?php

namespace App\Entities\Dono;

use App\Entities\EntitieAbstract;

class Dono extends EntitieAbstract
{
    public string $nome;
    public string $telefone;

    public function __construct(string $nome, string $telefone)
    {
        $this->nome = $nome;
        $this->telefone = $telefone;
    }
}