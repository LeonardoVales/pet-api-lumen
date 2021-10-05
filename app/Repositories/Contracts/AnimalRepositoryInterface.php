<?php

namespace App\Repositories\Contracts;

use App\Entities\EntityAbstract;

interface AnimalRepositoryInterface
{
    public function create(EntityAbstract $entity): EntityAbstract;
}