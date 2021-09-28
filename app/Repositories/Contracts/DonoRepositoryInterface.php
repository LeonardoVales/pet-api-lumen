<?php

namespace App\Repositories\Contracts;

use App\Entities\EntitieInterface;
use App\Models\Dono;

interface DonoRepositoryInterface 
{
    public function create(EntitieInterface $entitie): Dono;
}