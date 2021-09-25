<?php

namespace App\Repositories\Contracts;

use App\Entities\EntitieAbstract;

interface DonoRepositoryInterface 
{
    public function create(EntitieAbstract $entitie);
}