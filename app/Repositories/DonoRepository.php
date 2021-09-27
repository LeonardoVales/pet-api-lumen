<?php

namespace App\Repositories;

use App\Entities\EntitieAbstract;
use App\Repositories\Contracts\DonoRepositoryInterface;

class DonoRepository implements DonoRepositoryInterface
{
    public function create(EntitieAbstract $entitie)
    {
        return [];
    }
}