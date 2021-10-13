<?php

namespace App\Repositories;

use App\Entities\EntityAbstract;
use App\Models\Animal;
use App\Repositories\Contracts\AbstractRepository;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AnimalRepository extends AbstractRepository implements AnimalRepositoryInterface
{
    public function __construct(Animal $model)
    {
        parent::__construct($model);
    }

    public function create(EntityAbstract $entity): EntityAbstract
    {
        $animalCreated = $this->model::create($entity->jsonSerialize());
        
        return $animalCreated->getEntity();
    }

    public function update(EntityAbstract $entity): EntityAbstract
    {
        $model = $this->findModel($entity->getId());
        $model->fill($entity->jsonSerialize());
        $model->saveOrFail();

        return $model->getEntity();
    }

    public function delete(string $id): bool
    {
        return parent::deleteById($id);
    }

    public function all(): Collection
    {
        return parent::findAllWithRelationships(['dono']);
    }
}