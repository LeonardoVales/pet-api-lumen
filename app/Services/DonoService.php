<?php

namespace App\Services;

use App\Entities\Dono;
use App\Entities\EntityAbstract;
use App\Entities\EntityInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\ValueObjects\Telefone;

class DonoService 
{
    private DonoRepositoryInterface $donoRepository;

    public function __construct(DonoRepositoryInterface $donoRepository)
    {
        $this->donoRepository = $donoRepository;
    }

    public function create(array $data): EntityAbstract
    {
        $donoEntity = new Dono;
        $donoEntity->setNome($data['nome']);
        $donoEntity->setTelefone(new Telefone($data['telefone']));

        return $this->donoRepository->create($donoEntity);        
    }

}