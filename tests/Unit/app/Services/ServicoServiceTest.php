<?php

namespace Tests\Unit\App\Services;

use App\Entities\EntityAbstract;
use App\Exceptions\ServicoNotFoundException;
use App\Models\ServicoModel;
use App\Repositories\Contracts\ServicoRepositoryInterface;
use App\Repositories\ServicoRepository;
use App\Services\ServicoService;
use Illuminate\Http\Request;
use TestCase;
use Mockery;

class ServicoServiceTest extends TestCase
{
    private ServicoRepositoryInterface $servicoRepository;
    private EntityAbstract $entity;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();

        $servicoModel = ServicoModel::factory()->makeOne();
        $this->entity = $servicoModel->getEntity();
        

        $this->request = new Request([
            'nome' => $this->entity->getNome()
        ]);
        
        $this->servicoRepository = $this->createMock(ServicoRepository::class);        
    }

    public function test_deve_chamar_o_repositorio_para_cadastrar()
    {
        $servicoModel = ServicoModel::factory()->makeOne();     
        unset($servicoModel->id, $servicoModel->created_at, $servicoModel->updated_at);

        $servicoEntity = $servicoModel->getEntity();

        $request = new Request([
            'nome' => $servicoEntity->getNome()
        ]);
        
        /** @var \Mockery\MockInterface|ServicoRepository */        
        $servicoRepository = $this->createMock(ServicoRepository::class);
        $servicoRepository
            ->expects($this->once())
            ->method('create')
            ->with($servicoEntity);

        $service = new ServicoService($servicoRepository);
        $service->create($request);
    }

    public function test_deve_retornar_entidade_ao_cadastrar()
    {
        $this->servicoRepository->method('create')->willReturn($this->entity);
        $service = new ServicoService($this->servicoRepository);

        $this->assertInstanceOf(
            EntityAbstract::class,
            $service->create($this->request)
        );
    }

    public function test_deve_retornar_entidade_ao_atualizar()
    {
        $this->servicoRepository->method('update')->willReturn($this->entity);
        $this->servicoRepository->method('findEntity')->willReturn($this->entity);

        $service = new ServicoService($this->servicoRepository);

        $this->assertInstanceOf(
            EntityAbstract::class,
            $service->update($this->request, $this->entity->getId())
        );
    }

    public function test_deve_retornar_uma_excecao_se_o_servico_nao_existir_ao_atualizar()
    {
        $this->expectException(ServicoNotFoundException::class);
        $this->expectExceptionMessage('O tipo de serviço não foi encontrado');

        $this->servicoRepository->method('findEntity')->willReturn(null);        
        $service = new ServicoService($this->servicoRepository);

        $service->update($this->request, '9999');
    }

    public function test_deve_chamar_o_metodo_update_do_repositorio()
    {
        $servicoModel = ServicoModel::factory()->makeOne();     
        unset($servicoModel->created_at, $servicoModel->updated_at);

        $servicoEntity = $servicoModel->getEntity();

        $request = new Request([
            'nome' => $servicoEntity->getNome()
        ]);

        /** @var \Mockery\MockInterface|ServicoRepository */        
        $servicoRepository = $this->createMock(ServicoRepository::class);
        $servicoRepository->method('findEntity')
            ->willReturn($servicoEntity);

        $servicoRepository
            ->expects($this->once())
            ->method('update')
            ->with($servicoEntity);

        $service = new ServicoService($servicoRepository);
        $service->update($request, $servicoEntity->getId());
    }

    public function test_deve_chamar_o_metodo_findEntity_ao_atualizar()
    {
        $servicoModel = ServicoModel::factory()->makeOne();     
        unset($servicoModel->created_at, $servicoModel->updated_at);

        $servicoEntity = $servicoModel->getEntity();

        $request = new Request([
            'nome' => $servicoEntity->getNome()
        ]);

        /** @var \Mockery\MockInterface|ServicoRepository */        
        $servicoRepository = $this->createMock(ServicoRepository::class);
        $servicoRepository->method('update')
            ->willReturn($servicoEntity);
        $servicoRepository->method('findEntity')
            ->willReturn($servicoEntity);

        $servicoRepository->expects($this->once())
            ->method('findEntity')
            ->with($servicoEntity->getId());

        $service = new ServicoService($servicoRepository);
        $service->update($request, $servicoEntity->getId());
    }
}