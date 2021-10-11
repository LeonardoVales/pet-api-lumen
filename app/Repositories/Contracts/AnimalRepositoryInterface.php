<?php

namespace App\Repositories\Contracts;

use App\Entities\EntityAbstract;

interface AnimalRepositoryInterface
{
    public function create(EntityAbstract $entity): EntityAbstract;

    public function update(EntityAbstract $entity): EntityAbstract;

    public function delete(string $id): bool;
}