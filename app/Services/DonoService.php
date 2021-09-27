<?php

namespace App\Services;

use App\Entities\Dono;
use App\Entities\EntitieAbstract;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\ValueObjects\Telefone;

class DonoService 
{
    private DonoRepositoryInterface $donoRepository;
    private EntitieAbstract $donoEntitie;

    public function __construct(DonoRepositoryInterface $donoRepository)
    {
        $this->donoRepository = $donoRepository;
    }

    public function create(array $data)
    {
        $dono = $this->mapEntitie($data);
        dd($dono);
        
        
        // $this->donoRepository->create($donoEntitie);
    }

    public function mapEntitie(array $data)
    {
        $this->donoEntitie = new Dono;
        $this->donoEntitie->setNome($data['nome']);
        $this->donoEntitie->setTelefone(new Telefone($data['telefone']));

        return $this->donoEntitie;
    }
}