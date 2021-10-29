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
        $servicoRepository->method('update')->willReturn($servicoEntity);
        $servicoRepository->method('findEntity')->willReturn($servicoEntity);

        $servicoRepository->expects($this->once())
            ->method('findEntity')
            ->with($servicoEntity->getId());

        $service = new ServicoService($servicoRepository);
        $service->update($request, $servicoEntity->getId());
    }

    public function test_deve_chamar_o_metodo_delete_ao_deletar()
    {
        $servicoModel = ServicoModel::factory()->makeOne();     
        $servicoEntity = $servicoModel->getEntity();

        /** @var \Mockery\MockInterface|ServicoRepository */        
        $servicoRepository = $this->createMock(ServicoRepository::class);
        $servicoRepository->method('findEntity')->willReturn($servicoEntity);
        
        $servicoRepository->expects($this->once())
            ->method('delete')
            ->with($servicoEntity->getId());

        $service = new ServicoService($servicoRepository);
        $service->delete($servicoEntity->getId());
    }

    public function test_deve_retornar_uma_excecao_se_o_servico_nao_existir_ao_deletear()
    {
        $this->expectException(ServicoNotFoundException::class);
        $this->expectExceptionMessage('O tipo de serviço não foi encontrado');       

        /** @var \Mockery\MockInterface|ServicoRepository */ 
        $servicoRepository = $this->createMock(ServicoRepository::class);
        $servicoRepository->method('findEntity')->willReturn(null);

        $service = new ServicoService($servicoRepository);
        $service->delete('9999');
    }

    public function test_deve_ser_possivel_listar_todos_os_tipos_de_servico()
    {
        $servicosModel = ServicoModel::factory()->count(5)->make();

        /** @var \Mockery\MockInterface|ServicoRepository */ 
        $servicoRepository = $this->createMock(ServicoRepository::class);
        $servicoRepository->method('all')->willReturn($servicosModel);

        $service = new ServicoService($servicoRepository);
        $result = $service->all();

        $this->assertIsArray($result);
        $this->assertCount(5, $result);
    }

    public function test_deve_chamar_o_repositorio_para_listar()
    {
        $servicosModel = ServicoModel::factory()->count(5)->make();

            /** @var \Mockery\MockInterface|ServicoRepository */        
        $servicoRepository = $this->createMock(ServicoRepository::class);
        $servicoRepository
            ->expects($this->once())
            ->method('all')
            ->willReturn($servicosModel);

        $service = new ServicoService($servicoRepository);
        $service->all();
    }

    public function test_deve_ser_possivel_retornar_um_tipo_de_servico()
    {
        $servicoModel = ServicoModel::factory()->make();
        $servicoEntity = $servicoModel->getEntity();
        
        /** @var \Mockery\MockInterface|ServicoRepository */        
        $servicoRepository = $this->createMock(ServicoRepository::class);
        $servicoRepository
            ->expects($this->once())
            ->method('findModel')
            ->willReturn($servicoModel)
            ->with($servicoEntity->getId());

        $servicoRepository
            ->expects($this->once())
            ->method('find')
            ->willReturn($servicoEntity)
            ->with($servicoEntity->getId());

        $service = new ServicoService($servicoRepository);
        $service->findById($servicoEntity->getId()); 
    }

    public function test_deve_retornar_uma_excecao_se_o_servico_nao_existir_ao_consultar()
    {
        $this->expectException(ServicoNotFoundException::class);
        $this->expectExceptionMessage('O tipo de serviço não foi encontrado'); 
    
        /** @var \Mockery\MockInterface|ServicoRepository */        
        $servicoRepository = $this->createMock(ServicoRepository::class);
        $servicoRepository->method('findModel')->willReturn(null);      

        $service = new ServicoService($servicoRepository);
        $service->findById('9999'); 
    }
}