<?php

namespace App\Services;

use App\Entities\Dono;
use App\Entities\EntityAbstract;
use InvalidArgumentException;
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
        $donoEntity = $this->mapEntity($data);

        return $this->donoRepository->create($donoEntity);        
    }

    public function update(array $data, string $id): EntityAbstract
    {        
        $dono = $this->mapEntity($data);
        $dono->setId($id);

        if (!$this->donoRepository->findEntity($id)) {
            throw new InvalidArgumentException('O dono não foi encontrado');
        }

        return $this->donoRepository->update($dono);
    }

    public function delete(string $id): bool
    {
        if (!$this->donoRepository->findEntity($id)) {
            throw new InvalidArgumentException('O dono não foi encontrado');
        }

        return $this->donoRepository->delete($id);
    }

    private function mapEntity(array $data): EntityAbstract
    {
        $donoEntity = new Dono;
        $donoEntity->setNome($data['nome']);
        $donoEntity->setTelefone(new Telefone($data['telefone']));

        return $donoEntity;
    }

}