<?php

namespace App\Repositories;

use App\Entities\EntityAbstract;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Models\Dono;
use App\Repositories\Contracts\AbstractRepository;

class DonoRepository extends AbstractRepository implements DonoRepositoryInterface
{
    public function __construct(Dono $model)
    {
        parent::__construct($model);
    }

    public function create(EntityAbstract $entity): EntityAbstract
    {        
        $donoModel =  $this->model::create($entity->jsonSerialize());  
        
        return $donoModel->getEntity();

    }
}