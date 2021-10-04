<?php

namespace App\Repositories\Contracts;

use App\Entities\EntityInterface;
use Illuminate\Database\Eloquent\Model;

interface AnimalRepositoryInterface
{
    public function create(EntityInterface $entity): Model;
}