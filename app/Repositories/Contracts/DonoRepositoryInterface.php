<?php

namespace App\Repositories\Contracts;

use App\Entities\EntityAbstract;

interface DonoRepositoryInterface 
{
    public function create(EntityAbstract $entitie): EntityAbstract;
}