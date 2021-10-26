<?php

namespace App\Services;

use App\Entities\Animal;
use App\Entities\EntityAbstract;
use App\Exceptions\AnimalNotFoundException;
use App\Exceptions\DonoNotFoundException;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\ValueObjects\Especie;
use Illuminate\Database\Eloquent\Collection;
use App\ValueObjects\AnimalList;

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
            throw new DonoNotFoundException;
        }
        
        return $this->animalRepository->create($animal);
    }

    public function update(array $data, string $id): EntityAbstract
    {
        $animal = $this->mapEntity($data);
        $animal->setId($id);

        if (!$this->animalRepository->findEntity($id)) {
            throw new AnimalNotFoundException;            
        }

        if (!$this->donoRepository->findEntity($animal->getIdDono())) {
            throw new DonoNotFoundException;
        }

        return $this->animalRepository->update($animal);
    }

    public function delete(string $id): bool
    {
        if (!$this->animalRepository->findModel($id)) {
            throw new AnimalNotFoundException;
        }
        
        return $this->animalRepository->delete($id);
    }

    public function findById(string $id): EntityAbstract
    {
        if (!$this->animalRepository->findModel($id)) {
            throw new AnimalNotFoundException;
        }

        return $this->animalRepository->find($id);
    }

    public function all()
    {
        $animais = $this->animalRepository->all();
        $animalList = $this->generateAnimalList($animais);

        return $animalList->list;        
    }

    private function generateAnimalList(Collection $collectionAnimal): AnimalList
    {        
        $animalList = new AnimalList;
        foreach ($collectionAnimal as $collection) {
            $animalList->add($collection->getEntity());
        }

        return $animalList;
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