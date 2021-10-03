<?php

namespace App\Services;

use App\Entities\Dono;
use App\Entities\EntityInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\ValueObjects\Telefone;

class DonoService 
{
    private DonoRepositoryInterface $donoRepository;
    private EntityInterface $donoEntity;

    public function __construct(DonoRepositoryInterface $donoRepository)
    {
        $this->donoRepository = $donoRepository;
    }

    public function create(array $data): EntityInterface
    {
        $donoEntity = $this->mapEntitie($data);
        $this->donoRepository->create($donoEntity);

        return $donoEntity;
    }

    public function mapEntitie(array $data)
    {
        $this->donoEntity = new Dono;

        $this->donoEntity->setNome($data['nome']);
        $this->donoEntity->setTelefone(new Telefone($data['telefone']));
   
        return $this->donoEntity;
    }
}