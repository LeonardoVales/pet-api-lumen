<?php

namespace App\Services;

use App\Entities\Animal;
use App\Entities\EntityAbstract;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\ValueObjects\Especie;

class AnimalService
{
    private AnimalRepositoryInterface $animalRepository;

    public function __construct(AnimalRepositoryInterface $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }

    public function create(array $data): EntityAbstract
    {
        $animal = new Animal;
        $animal->setNome($data['nome']);
        $animal->setIdade($data['idade']);
        $animal->setEspecie(new Especie($data['especie']));
        $animal->setRaca($data['raca']);
        $animal->setIdDono($data['id_dono']);

        return $this->animalRepository->create($animal);
    }
}