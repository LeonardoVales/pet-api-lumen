<?php

use App\Entities\Dono as DonoEntitie;
use App\Http\Controllers\DonoController;
use App\Models\Dono;
use App\Services\DonoService;
use App\ValueObjects\Telefone;
use Laravel\Lumen\Testing\DatabaseMigrations;

class DonoControllerTest extends TestCase
{
    use DatabaseMigrations;

    private DonoService $donoService;
    private DonoEntitie $donoEntitie;

    protected function setUp(): void
    {
        parent::setUp();

        $dono = Dono::factory()->make();

        $this->donoEntitie = new DonoEntitie;
        $this->donoEntitie->setNome($dono->nome);
        $this->donoEntitie->setTelefone(new Telefone($dono->telefone));
        
        $this->donoService = $this->createMock(DonoService::class);
        $this->donoService->method('mapEntitie')->willReturn($this->donoEntitie);
        $this->donoService->method('create')->willReturn($this->donoEntitie);

        
    }

    public function test_create_deve_retornar_status_201()
    {
        // aqui eu tenho que criar uma request
        $donoController = new DonoController($this->donoService);
        $result = $donoController->create
    }
}