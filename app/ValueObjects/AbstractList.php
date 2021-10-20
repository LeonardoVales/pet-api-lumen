<?php

namespace App\ValueObjects;

use App\Entities\EntityAbstract;

class AbstractList implements \Countable
{
    public array $list = [];

    protected function add(EntityAbstract $entity): void
    {
        $this->list[] = $entity->jsonSerialize();
    }

    public function count(): int
    {
        return count($this->list);
    }
}