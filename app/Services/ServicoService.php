<?php

namespace App\Services;

use App\Entities\EntityAbstract;
use App\Entities\ServicoEntity;
use App\Exceptions\ServicoNotFoundException;
use App\Repositories\Contracts\ServicoRepositoryInterface;
use Illuminate\Http\Request;

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

    private function mapEntity(Request $request): EntityAbstract
    {
        $servicoEntity = new ServicoEntity;
        $servicoEntity->setNome($request->input('nome'));
        
        return $servicoEntity;
    }
}