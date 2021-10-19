<?php

namespace App\ValueObjects;

use App\Entities\EntityAbstract;

class AnimalList implements \Countable
{
    public array $list = [];

    public function add(EntityAbstract $animal): void
    {
        $this->list[] = $animal->jsonSerialize();
    }

    public function count(): int
    {
        return count($this->list);
    }
}