<?php

namespace App\Services;

use App\Entities\Dono;
use App\Repositories\Contracts\DonoRepositoryInterface;

class DonoService 
{
    private DonoRepositoryInterface $donoRepository;

    public function __construct(DonoRepositoryInterface $donoRepository)
    {
        $this->donoRepository = $donoRepository;
    }

    public function create(array $data)
    {
        $donoEntitie = new Dono($data);
        
        $this->donoRepository->create($donoEntitie);
    }
}