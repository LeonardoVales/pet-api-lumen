<?php

namespace App\Repositories\Contracts;

use App\Entities\EntityInterface;
use App\Models\Animal;

interface AnimalRepositoryInterface
{
    public function create(EntityInterface $entitie): Animal;
}