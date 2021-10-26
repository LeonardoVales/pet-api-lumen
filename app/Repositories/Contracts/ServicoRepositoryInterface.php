<?php

namespace App\Repositories\Contracts;

use App\Entities\EntityAbstract;
use Illuminate\Database\Eloquent\Collection;

interface ServicoRepositoryInterface
{
    public function create(EntityAbstract $entity): EntityAbstract;

    public function update(EntityAbstract $entity): EntityAbstract;

    public function delete(string $id): bool;

    public function all(): Collection;

    public function find(string $id): EntityAbstract;
}