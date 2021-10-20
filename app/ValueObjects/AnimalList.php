<?php

namespace App\ValueObjects;

use App\Entities\EntityAbstract;

class AnimalList extends AbstractList
{
    public function add(EntityAbstract $entity): void
    {
        parent::add($entity);
    }
}