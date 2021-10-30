<?php

use App\Entities\EntityAbstract;
use App\Models\ServicoModel;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ServicoControllerTest extends TestCase
{
    use DatabaseMigrations;

    private EntityAbstract $servicoEntity;

    protected function setUp(): void
    {
        parent::setUp();

        $servicoModel = ServicoModel::factory()->create();
        $this->servicoEntity = $servicoModel->getEntity();
    }

    public function test_deve_ser_possivel_criar_um_servico()
    {
        $response = $this->post(
            '/servico', 
            $this->servicoEntity->jsonSerialize()
        );
        
        $response->assertResponseStatus(201);
        $response->seeInDatabase('servico', [
            'id' => $this->servicoEntity->getId(),
            'nome' => $this->servicoEntity->getNome(),
        ]);
    }

    public function test_deve_ser_possivel_atualizar_um_servico()
    {
        $servicoModel = ServicoModel::factory()->create();
        $servicoEntity = $servicoModel->getEntity();

        $servicoModelForUpdate = ServicoModel::factory()->makeOne();
        $servicoUpdateEntity = $servicoModelForUpdate->getEntity() ;
        $servicoUpdateEntity->setId($servicoEntity->getId());

        $response = $this->put(
            '/servico/'.$servicoEntity->getId(),
            $servicoUpdateEntity->jsonSerialize()
        );

        $response->assertResponseStatus(204);
        $response->seeInDatabase('servico', [
            'id' => $servicoEntity->getId(),
            'nome' => $servicoUpdateEntity->getNome()
        ])->notSeeInDatabase('servico', [
            'nome' => $servicoEntity->getNome()
        ]);
    }

    public function test_deve_ser_possivel_deletar_um_servico()
    {
        $servicoModel = ServicoModel::factory()->create();
        $servicoEntity = $servicoModel->getEntity();

        $response = $this->delete(
            '/servico/'.$servicoEntity->getId(),
            $servicoEntity->jsonSerialize()
        );

        $response->assertResponseStatus(204);
        $response->notSeeInDatabase('servico', [
            'id' => $servicoEntity->getId(),
            'deleted_at' => null
        ]);
    }

    public function test_deve_ser_possivel_listar_todos_os_servicos()
    {
        ServicoModel::factory()->count(5)->create();

        $response = $this->get('/servicos');
        $response->seeStatusCode(200);        
        $response->seeJsonStructure([
            '*' => [
                'id', 'nome', 'created_at',
                'updated_at', 'deleted_at'
            ]
        ]);
    }

    public function test_deve_ser_possivel_retornar_um_servico()
    {
        $servicoModel = ServicoModel::factory()->create();
        $servicoEntity = $servicoModel->getEntity();

        $response = $this->get('/servico/'.$servicoEntity->getId());
        $response->seeStatusCode(200);
        $response->seeJsonStructure([
            'id', 'nome', 'created_at',
            'updated_at', 'deleted_at'
        ]);
    }
}