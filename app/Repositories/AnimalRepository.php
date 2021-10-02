<?php

namespace App\Repositories;

use App\Entities\EntitieInterface;
use App\Models\Dono;
use App\Repositories\Contracts\AnimalRepositoryInterface;

class AnimalRepository implements AnimalRepositoryInterface
{
    public function create(EntitieInterface $entitie): Dono
    {
        
    }
}