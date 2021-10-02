<?php

namespace App\Services;

use App\Entities\Dono;
use App\Entities\EntitieInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\ValueObjects\Telefone;

class DonoService 
{
    private DonoRepositoryInterface $donoRepository;
    private EntitieInterface $donoEntitie;

    public function __construct(DonoRepositoryInterface $donoRepository)
    {
        $this->donoRepository = $donoRepository;
    }

    public function create(array $data): EntitieInterface
    {
        $donoEntitie = $this->mapEntitie($data);
        $this->donoRepository->create($donoEntitie);

        return $donoEntitie;
    }

    public function mapEntitie(array $data)
    {
        $this->donoEntitie = new Dono;

        $this->donoEntitie->setNome($data['nome']);
        $this->donoEntitie->setTelefone(new Telefone($data['telefone']));
   
        return $this->donoEntitie;
    }
}