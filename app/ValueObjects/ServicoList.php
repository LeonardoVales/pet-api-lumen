<?php

namespace App\ValueObjects;

use App\Entities\EntityAbstract;

class ServicoList
{
    public array $list = [];

    public function add(EntityAbstract $servico): void
    {
        $this->list[] = $servico->jsonSerialize();
    }
}