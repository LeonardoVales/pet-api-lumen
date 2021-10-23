<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Repositories\DonoRepository;
use App\Services\DonoService;
use App\Models\Dono;
use App\Entities\Dono as DonoEntity;
use App\Entities\EntityAbstract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PhpParser\ErrorHandler\Collecting;

class DonoServiceTest extends TestCase
{
    use DatabaseMigrations;

    private DonoRepositoryInterface $donoRepositoryMock;
    private DonoService $donoService;
    private DonoEntity $donoEntity;
    private array $data;
    private $donoModel;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->donoModel = Dono::factory()->makeOne();
        $this->donoEntity = $this->donoModel->getEntity();

        $this->donoRepositoryMock = $this->createMock(DonoRepository::class);

        $this->donoService = new DonoService($this->donoRepositoryMock);

        $this->request = new Request([
            'nome' => $this->donoModel->nome,
            'telefone' => $this->donoModel->telefone
        ]);
    }

    public function test_create_deve_retornar_instancia_entidade_dono()
    {
        $this->donoRepositoryMock->method('create')->willReturn($this->donoEntity);
        $donoService = new DonoService($this->donoRepositoryMock);

        $donoEntity = $donoService->create($this->request);
    
        $this->assertInstanceOf(
            EntityAbstract::class,
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

    public function test_deve_retornar_uma_excecao_se_o_dono_nao_existir_ao_atualizar()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('O dono não foi encontrado');

        $this->donoRepositoryMock->method('update')->willReturn($this->donoEntity);
        $this->donoRepositoryMock->method('findEntity')->willReturn(null);

        $donoService = new DonoService($this->donoRepositoryMock);
        $donoService->update($this->request, '9999999');
    }

    public function test_deve_retornar_entidade_dono_ao_atualizar()
    {
        $this->donoRepositoryMock->method('findEntity')->willReturn($this->donoEntity);
        $this->donoRepositoryMock->method('update')->willReturn($this->donoEntity);

        $donoService = new DonoService($this->donoRepositoryMock);
        $donoEntityUpdated = $donoService->update(
            $this->request,
            $this->donoEntity->getId()
        );

        $this->assertInstanceOf(
            EntityAbstract::class,
            $donoEntityUpdated
        );
    }

    public function test_deve_retornar_uma_excecao_se_o_dono_nao_existir_ao_deletar()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('O dono não foi encontrado');  
        
        $this->donoRepositoryMock->method('findEntity')->willReturn(null);

        $donoService = new DonoService($this->donoRepositoryMock);
        $donoService->delete('99877678687');
    }

    public function test_deve_retornar_boolean_ao_deletar()
    {
        $this->donoRepositoryMock->method('findEntity')->willReturn($this->donoEntity);

        $donoService = new DonoService($this->donoRepositoryMock);
        $donoDeleted = $donoService->delete($this->donoEntity->getId());

        $this->assertIsBool($donoDeleted);
    }

    public function test_deve_listar_todos_os_donos_em_array()
    {
        $this->donoRepositoryMock->method('all')->willReturn($this->generateCollectionDono());
        
        $donoService = new DonoService($this->donoRepositoryMock);
        $donosList = $donoService->all();

        $this->assertIsArray($donosList);
    }

    private function generateCollectionDono(): Collection
    {
        $collection = new Collection([
            Dono::factory()->makeOne(),
            Dono::factory()->makeOne(),
            Dono::factory()->makeOne(),
            Dono::factory()->makeOne(),
            Dono::factory()->makeOne(),
        ]);

        return $collection;
    }
}