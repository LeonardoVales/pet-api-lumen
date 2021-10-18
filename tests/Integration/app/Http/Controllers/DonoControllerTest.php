<?php

use App\Entities\Dono as DonoEntitie;
use App\Http\Controllers\DonoController;
use App\Models\Dono;
use App\Services\DonoService;
use App\ValueObjects\Telefone;
use Illuminate\Http\Request;
use App\Http\Controllers\Requests\DonoRequest;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Entities\EntitieInterface;

class DonoControllerTest extends TestCase
{
    use DatabaseMigrations;

    private DonoService $donoService;
    private DonoEntitie $donoEntitie;
    private Dono $donoModel;
    // private DonoRequest $donoRequest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->donoModel = Dono::factory()->make();        
    }

    public function test_create_deve_retornar_status_201()
    {        
        $data = [
            'nome' => $this->donoModel->nome,
            'telefone' => $this->donoModel->telefone
        ];
        $response = $this->post('/dono', $data);
        
        $response->assertResponseStatus(201);
    }

    public function test_update_deve_retornar_status_204()
    {
        $donoModel = Dono::factory()->create();
        $donoEntity = $donoModel->getEntity();
    
        $response = $this->put(
            '/dono/'.$donoEntity->getId(),
            $donoEntity->jsonSerialize()
        );

        $response->assertResponseStatus(204);
    }

    public function test_deve_atualizar_os_dados_do_dono()
    {
        $donoCreated = Dono::factory()->create();
        $donoEntityCreated = $donoCreated->getEntity();

        $donoUpdated = Dono::factory()->create();
        $donoEntityUpdated = $donoUpdated->getEntity();
        $donoEntityUpdated->setId($donoEntityCreated->getId());

        $response = $this->put(
            '/dono/'.$donoEntityUpdated->getId(),
            $donoEntityUpdated->jsonSerialize()
        );

        $response->seeInDatabase('dono', [
            'id' => $donoEntityUpdated->getId(),
            'nome' => $donoEntityUpdated->getNome(),
            'telefone' => $donoEntityUpdated->getTelefone(),
        ]);
    }

    public function test_deve_deletar_o_dono()
    {
        $donoCreated = Dono::factory()->create();
        $donoEntityCreated = $donoCreated->getEntity();

        $response = $this->delete('/dono/'.$donoEntityCreated->getId());
        $response->assertResponseStatus(204);
        $response->notSeeInDatabase('dono', [
            'id' => $donoEntityCreated->getId(),
            'deleted_at' => null
        ]);
    }
}