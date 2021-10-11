<?php

namespace App\Services;

use App\Entities\Animal;
use App\Entities\EntityAbstract;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\ValueObjects\Especie;
use InvalidArgumentException;

class AnimalService
{
    private AnimalRepositoryInterface $animalRepository;
    private DonoRepositoryInterface $donoRepository;

    public function __construct(
        AnimalRepositoryInterface $animalRepository,
        DonoRepositoryInterface $donoRepository
    )
    {        
        $this->animalRepository = $animalRepository;
        $this->donoRepository = $donoRepository;        
    }

    public function create(array $data): EntityAbstract
    {
        $animal = $this->mapEntity($data);
                
        if (!$this->donoRepository->findEntity($animal->getIdDono())) {
            throw new InvalidArgumentException('O dono do animal não foi encontrado');
        }
        
        return $this->animalRepository->create($animal);
    }

    public function update(array $data, string $id): EntityAbstract
    {
        $animal = $this->mapEntity($data);
        $animal->setId($id);

        if (!$this->animalRepository->findEntity($id)) {
            throw new InvalidArgumentException('O animal não foi encontrado');
        }

        if (!$this->donoRepository->findEntity($animal->getIdDono())) {
            throw new InvalidArgumentException('O dono do animal não foi encontrado');            
        }

        return $this->animalRepository->update($animal);
    }

    private function mapEntity(array $data): EntityAbstract
    {
        $animal = new Animal;
        $animal->setNome($data['nome']);
        $animal->setIdade($data['idade']);
        $animal->setEspecie(new Especie($data['especie']));
        $animal->setRaca($data['raca']);
        $animal->setIdDono($data['id_dono']);

        return $animal;
    }

}