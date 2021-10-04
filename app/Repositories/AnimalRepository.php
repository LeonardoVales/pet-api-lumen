<?php

namespace App\Repositories;

use App\Entities\EntityInterface;
use App\Repositories\Contracts\AbstractRepository;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Models\Animal;

class AnimalRepository extends AbstractRepository implements AnimalRepositoryInterface
{
    public function create(EntityInterface $entity): Animal
    {
        return $this->model::create($entity->toArray());        
    }
}