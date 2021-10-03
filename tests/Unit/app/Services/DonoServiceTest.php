<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Entities\EntityInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Repositories\DonoRepository;
use App\Services\DonoService;
use App\Models\Dono;
use App\Entities\Dono as DonoEntity;
use App\ValueObjects\Telefone;

class DonoServiceTest extends TestCase
{
    use DatabaseMigrations;

    private DonoRepositoryInterface $donoRepositoryMock;
    private DonoService $donoService;
    private DonoEntity $donoEntity;
    private array $data;
    private $donoModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->donoModel = Dono::factory()->make();

        $this->donoRepositoryMock = $this->createMock(DonoRepository::class);
        $this->donoRepositoryMock->method('create')->willReturn($this->donoModel);

        $this->donoService = new DonoService($this->donoRepositoryMock);
        $this->donoEntity = $this->donoService->mapEntitie([
            'nome' => $this->donoModel->nome,
            'telefone' => $this->donoModel->telefone,
        ]);
    }

    public function test_create_deve_retornar_instancia_entidade_dono()
    {
        $donoEntity = $this->donoService->create([
            'nome' => $this->donoModel->nome,
            'telefone' => $this->donoModel->telefone
        ]);

        $this->assertInstanceOf(
            EntityInterface::class,
            $donoEntity
        );

        $this->assertSame(
            $this->donoModel->nome,
            $donoEntity->getNome()
        );

        $this->assertSame(
            $this->donoModel->telefone,
            $donoEntity->getTelefone()
        );
    }

    public function test_map_entitie_deve_retornar_entidade_dono()
    {
        $this->assertInstanceOf(
            EntityInterface::class, 
            $this->donoEntity
        );
    }


}