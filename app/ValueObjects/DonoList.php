<?php

namespace App\ValueObjects;

use App\Entities\EntityAbstract;

class DonoList implements \Countable
{
    public array $list = [];

    public function add(EntityAbstract $dono): void
    {
        $this->list[] = $dono->jsonSerialize();
    }

    public function count(): int
    {
        return count($this->list);
    }
}