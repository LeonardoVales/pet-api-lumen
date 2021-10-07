<?php

namespace App\Services;

use App\Entities\Animal;
use App\Entities\EntityAbstract;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\ValueObjects\Especie;
use InvalidArgumentException;

class AnimalService
{
    private AnimalRepositoryInterface $animalRepository;

    public function __construct(AnimalRepositoryInterface $animalRepository)
    {        
        $this->animalRepository = $animalRepository;        
    }

    public function create(array $data): EntityAbstract
    {
        $animal = $this->mapEntity($data);

        return $this->animalRepository->create($animal);
    }

    public function update(array $data, string $id): EntityAbstract
    {
        if (!$this->animalRepository->findEntity($id)) {
            throw new InvalidArgumentException('A animal não foi encontrado');
        }

        $animal = $this->mapEntity($data);
        $animal->setId($id);

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