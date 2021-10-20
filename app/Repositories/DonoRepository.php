<?php

namespace App\Repositories;

use App\Entities\EntityAbstract;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Models\Dono;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class DonoRepository extends AbstractRepository implements DonoRepositoryInterface
{
    public function __construct(Dono $model)
    {
        parent::__construct($model);
    }

    public function create(EntityAbstract $entity): EntityAbstract
    {        
        return parent::create($entity);
    }

    public function update(EntityAbstract $entity): EntityAbstract
    {
        return parent::update($entity);
    }

    public function delete(string $id): bool
    {
        return parent::deleteById($id);
    }

    public function all(): Collection
    {
        return parent::findAll();
    }
}