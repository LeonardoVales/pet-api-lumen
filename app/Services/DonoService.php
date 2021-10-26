<?php

namespace App\Services;

use App\Entities\Dono;
use App\Entities\EntityAbstract;
use App\Exceptions\DonoNotFoundException;
use InvalidArgumentException;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\ValueObjects\DonoList;
use App\ValueObjects\Telefone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DonoService 
{
    private DonoRepositoryInterface $donoRepository;

    public function __construct(DonoRepositoryInterface $donoRepository)
    {
        $this->donoRepository = $donoRepository;
    }

    public function create(Request $request): EntityAbstract
    {
        $donoEntity = $this->mapEntity($request);

        return $this->donoRepository->create($donoEntity);        
    }

    public function update(Request $request, string $id): EntityAbstract
    {        
        $dono = $this->mapEntity($request);
        $dono->setId($id);

        if (!$this->donoRepository->findEntity($id)) {
            throw new DonoNotFoundException;          
        }

        return $this->donoRepository->update($dono);
    }

    public function delete(string $id): bool
    {
        if (!$this->donoRepository->findEntity($id)) {
            throw new DonoNotFoundException;
        }

        return $this->donoRepository->delete($id);
    }

    public function all(): array
    {
        $donos = $this->donoRepository->all();
        $donosList = $this->generateDonoList($donos);

        return $donosList->list;
    }

    private function generateDonoList(Collection $collectionsDono): DonoList
    {
        $donoList = new DonoList;
        foreach ($collectionsDono as $collection) {                       
            $donoList->add($collection->getEntity());
        }

        return $donoList;
    }

    private function mapEntity(Request $request): EntityAbstract
    {
        $donoEntity = new Dono;
        $donoEntity->setNome($request->input('nome'));
        $donoEntity->setTelefone(new Telefone($request->input('telefone')));

        return $donoEntity;
    }

}