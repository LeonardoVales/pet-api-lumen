<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Entities\EntitieInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Repositories\DonoRepository;
use App\Services\DonoService;
use App\Models\Dono;

class DonoServiceTest extends TestCase
{
    use DatabaseMigrations;

    private DonoRepositoryInterface $donoRepositoryMock;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();

        // $teste = Dono::factory()->create();
        // dd($teste);
        

        $this->data = [
            'nome' => 'Leonardo Vales',
            'telefone' => '31986623642',
        ];
        $this->donoRepositoryMock = $this->createMock(DonoRepository::class);
        
    }

    public function test_deve_retornar_entidade_dono()
    {
        $donoService = new DonoService($this->donoRepositoryMock);

        $this->assertInstanceOf(
            EntitieInterface::class, 
            $donoService->mapEntitie($this->data)
        );
    }
}