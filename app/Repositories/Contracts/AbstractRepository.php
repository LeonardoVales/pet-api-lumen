<?php

namespace App\Repositories\Contracts;

use App\Entities\EntityAbstract;
use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(EntityAbstract $entity): EntityAbstract
    {        
        $created = $this->model::create($entity->jsonSerialize());

        return $created->getEntity();
    }

    public function update(EntityAbstract $entity): EntityAbstract
    {
        $model = $this->findModel($entity->getId());
        $model->fill($entity->jsonSerialize());
        $model->saveOrFail();

        return $model->getEntity();
    }

    public function findModel(string $id): ?AbstractModel
    {
        $model = $this->model::find($id);
        if (!$model) {
            return null;
        }

        return $model;
    }

    public function findEntity(string $id): ?EntityAbstract
    {
        $model = $this->findModel($id);                
        if (!$model) {
            return null;
        }
        
        return $model->getEntity();
    }

    protected function deleteById(string $id): bool
    {
        $model = $this->findModel($id);
        if (!$model) {
            return false;
        }
        return $model->delete();
    }

    protected function findAll(): Collection
    {
        return $this->model->all();
    }

    protected function findAllWithRelationships(array $relationships): Collection
    {
        return $this->model->with($relationships)->get();
    }
}