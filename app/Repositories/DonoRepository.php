<?php

namespace App\Repositories;

use App\Entities\EntitieInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Models\Dono;

class DonoRepository implements DonoRepositoryInterface
{
    public function create(EntitieInterface $entitie): EntitieInterface
    {
        Dono::create($entitie->toArray());

        return $entitie;
    }
}