<?php

namespace App\Repositories;

use App\Entities\EntityAbstract;
use App\Models\ServicoModel;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\AbstractRepository;
use App\Repositories\Contracts\ServicoRepositoryInterface;

class ServicoRepository extends AbstractRepository implements ServicoRepositoryInterface
{    
    public function __construct(ServicoModel $model)
    {
        parent::__construct($model)       ;
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

    public function find(string $id): EntityAbstract
    {
        return parent::findEntity($id);
    }
}