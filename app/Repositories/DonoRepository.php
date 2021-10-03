<?php

namespace App\Repositories;

use App\Entities\EntityInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Models\Dono;

class DonoRepository implements DonoRepositoryInterface
{
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