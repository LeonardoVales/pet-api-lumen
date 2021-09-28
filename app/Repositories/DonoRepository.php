<?php

namespace App\Repositories;

use App\Entities\EntitieInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Models\Dono;

class DonoRepository implements DonoRepositoryInterface
{
    public function create(EntitieInterface $entitie): Dono
    {
        $donoModel = new Dono;

        $donoModel->id = $entitie->getId();
        $donoModel->nome = $entitie->getNome();
        $donoModel->telefone = $entitie->getTelefone();

        $donoModel->save();

       return $donoModel;
    }
}