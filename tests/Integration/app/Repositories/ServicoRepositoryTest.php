<?php

use App\Entities\EntityAbstract;
use App\Models\ServicoModel;
use App\Repositories\Contracts\ServicoRepositoryInterface;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ServicoRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private const INSERT = 'insert';
    private const UPDATE = 'update';

    private ServicoRepositoryInterface $servicoRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->servicoRepository = app(ServicoRepositoryInterface::class);
    }

    public function test_deve_ser_possivel_criar_um_tipo_de_servico()
    {
        $servicoModel = ServicoModel::factory()->create();
        $servicoEntity = $servicoModel->getEntity();

        $this->servicoRepository->create($servicoEntity);

        $this->seeInDatabase('servico', [
            'id' => $servicoEntity->getId(),
            'nome' => $servicoEntity->getNome(),
        ]);
    }

    public function test_deve_retornar_uma_instancia_ao_cadastrar()
    {
        $servicoModel = ServicoModel::factory()->create();
        $servicoEntity = $servicoModel->getEntity();

        $result = $this->servicoRepository->create($servicoEntity);

        $this->assertInstanceOf(
            EntityAbstract::class,
            $result
        );
    }

    public function test_deve_ser_possivel_atualizar_um_tipo_de_servico()
    {
        $servicoModelCreated = ServicoModel::factory()->create();
        $servicoEntityCreated = $servicoModelCreated->getEntity();

        $servicoModelForUpdate = ServicoModel::factory()->makeOne();
        $servicoEntityForUpdate = $servicoModelForUpdate->getEntity();
        $servicoEntityForUpdate->setId($servicoEntityCreated->getId());

        $this->servicoRepository->update($servicoEntityForUpdate);

        $this->seeInDatabase('servico', [
            'id' => $servicoEntityCreated->getId(),
            'nome' => $servicoEntityForUpdate->getNome(),
        ])->notSeeInDatabase('servico', [
            'nome' => $servicoEntityCreated->getNome(),
        ]);
    }

    public function test_deve_retornar_uma_instancia_ao_atualizar()
    {
        $servicoEntityCreated = ServicoModel::factory()->create();
        $result = $this->servicoRepository->update($servicoEntityCreated->getEntity());

        $this->assertInstanceOf(
            EntityAbstract::class,
            $result
        );
    }

    public function test_deve_ser_possivel_deletar_tipo_servico()
    {
        $servicoEntityCreated = ServicoModel::factory()->create();
        $servicoEntity = $servicoEntityCreated->getEntity();
        
        $result = $this->servicoRepository->delete($servicoEntity->getId());
        
        $this->assertTrue($result);
        $this->notSeeInDatabase('servico', [
            'id' => $servicoEntity->getId(),
            'deleted_at' => null
        ]);
    }

    public function test_deve_ser_possivel_recuperar_um_tipo_de_servico()
    {
        $servicoModelCreated = ServicoModel::factory()->create();
        $servicoEntity = $servicoModelCreated->getEntity();

        $result = $this->servicoRepository->find($servicoEntity->getId());

        $this->assertInstanceOf(
            EntityAbstract::class,
            $result
        );
        $this->assertEquals(
            $servicoEntity->getId(),
            $result->getId()
        );
        $this->assertEquals(
            $servicoEntity->getNome(),
            $result->getNome()
        );
    }

    public function test_deve_ser_possivel_retornar_varios_tipos_de_servicos()
    {
        ServicoModel::factory()->count(5)->create();

        $servicos = $this->servicoRepository->all();
        $this->assertCount(5, $servicos);
    }

}