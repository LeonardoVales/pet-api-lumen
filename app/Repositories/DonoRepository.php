<?php

namespace App\Repositories;

use App\Entities\EntityInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Models\Dono;
use App\Repositories\Contracts\AbstractRepository;

class DonoRepository extends AbstractRepository implements DonoRepositoryInterface
{
    public function __construct(Dono $model)
    {
        parent::__construct($model);
    }

    public function create(EntityInterface $entitie): Dono
    {
        $donoModel = new Dono;

        $donoModel->id = $entitie->getId();
        $donoModel->nome = $entitie->getNome();
        $donoModel->telefone = $entitie->getTelefone();

        $donoModel->save();

       return $donoModel;
    }
}