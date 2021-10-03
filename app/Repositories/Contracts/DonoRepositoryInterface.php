<?php

namespace App\Repositories\Contracts;

use App\Entities\EntityInterface;
use App\Models\Dono;

interface DonoRepositoryInterface 
{
    public function create(EntityInterface $entitie): Dono;
}