<?php

namespace App\Repositories\Contracts;

use App\Entities\EntityAbstract;
use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
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

    protected function deleteById($id): bool
    {
        $model = $this->findModel($id);
        if (!$model) {
            return false;
        }
        return $model->delete();
    }
}