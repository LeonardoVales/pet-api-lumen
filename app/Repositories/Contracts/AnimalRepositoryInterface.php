<?php

namespace App\Repositories\Contracts;

use App\Entities\EntitieInterface;
use App\Models\Animal;

interface AnimalRepositoryInterface
{
    public function create(EntitieInterface $entitie): Animal;
}