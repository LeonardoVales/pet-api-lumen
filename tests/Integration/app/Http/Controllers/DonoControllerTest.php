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

        // $this->donoEntitie = new DonoEntitie;
        // $this->donoEntitie->setNome($this->donoModel->nome);
        // $this->donoEntitie->setTelefone(new Telefone($this->donoModel->telefone));
        
        // $this->donoService = $this->createMock(DonoService::class);
        // $this->donoService->method('mapEntitie')->willReturn($this->donoEntitie);
        // $this->donoService->method('create')->willReturn($this->donoEntitie);

        
    }

    public function test_create_deve_retornar_status_201()
    {        
        $data = [
            'nome' => $this->donoModel->nome,
            'telefone' => $this->donoModel->telefone
        ];
        $request = $this->post('/dono', $data);
        
        $request->assertResponseStatus(201);
    }

    // public function test_create_deve_retornar_os_dados_do_dono()
    // {
    //     $data = [
    //         'nome' => $this->donoModel->nome,
    //         'telefone' => $this->donoModel->telefone
    //     ];
    //     $request = $this->post('/dono', $data);
    //     // dd($request);
    //     $request->assertInstanceOf()
    // }
}