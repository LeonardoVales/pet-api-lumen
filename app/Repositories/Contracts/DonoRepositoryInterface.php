<?php

namespace App\Repositories\Contracts;

use App\Entities\EntitieInterface;

interface DonoRepositoryInterface 
{
    public function create(EntitieInterface $entitie): EntitieInterface;
}