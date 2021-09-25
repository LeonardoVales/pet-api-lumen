<?php

namespace App\Entities;

use App\Entities\EntitieAbstract;

class Dono extends EntitieAbstract
{
    public string $nome;
    public string $telefone;

    public function __construct(array $data)
    {
        $this->nome = $data['nome'];
        $this->telefone = $data['telefone'];
    }
}