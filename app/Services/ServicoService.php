<?php

namespace App\Services;

use App\Entities\EntityAbstract;
use App\Entities\ServicoEntity;
use App\Exceptions\ServicoNotFoundException;
use App\Repositories\Contracts\ServicoRepositoryInterface;
use App\ValueObjects\ServicoList;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ServicoService
{
    private ServicoRepositoryInterface $servicoRepository;

    public function __construct(ServicoRepositoryInterface $repository)
    {
        $this->servicoRepository = $repository;
    }

    public function create(Request $request): EntityAbstract
    {        
        $servicoEntity = $this->mapEntity($request);
        
        return $this->servicoRepository->create($servicoEntity);
    }

    public function update(Request $request, string $id): EntityAbstract
    {
        if (!$this->servicoRepository->findEntity($id)) {
            throw new ServicoNotFoundException;
        }

        $servico = $this->mapEntity($request);
        $servico->setId($id);

        return $this->servicoRepository->update($servico);
    }

    public function delete(string $id): bool
    {
        if (!$this->servicoRepository->findEntity($id)) {
            throw new ServicoNotFoundException;
        }

        return $this->servicoRepository->delete($id);
    }

    public function all(): array
    {
        $models = $this->servicoRepository->all();
        $servicosList = $this->generateServicoList($models);

        return $servicosList->list;
    }

    public function findByid(string $id): EntityAbstract
    {
        if (!$this->servicoRepository->findModel($id)) {
            throw new ServicoNotFoundException;
        }

        return $this->servicoRepository->find($id);
    }

    private function generateServicoList(Collection $collectionsServico): ServicoList
    {
        $servicoList = new ServicoList;
        foreach ($collectionsServico as $collection) {
            $servicoList->add($collection->getEntity());
        }

        return $servicoList;
    }

    private function mapEntity(Request $request): EntityAbstract
    {
        $servicoEntity = new ServicoEntity;
        $servicoEntity->setNome($request->input('nome'));

        return $servicoEntity;
    }
}