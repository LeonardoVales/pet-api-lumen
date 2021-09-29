<?php

// namespace Unit\app\Repositories;

use App\Entities\Dono as EntitieDono;
use App\Entities\EntitieInterface;
use App\Models\Dono;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Repositories\DonoRepository;
use App\Services\DonoService;
use App\ValueObjects\Telefone;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Ramsey\Uuid\Uuid;

// use Laravel\Lumen\Testing\TestCase;


class DonoRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private DonoRepositoryInterface $donoRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->donoRepository = new DonoRepository;
    }

    public function test_deve_retornar_a_model_com_os_dados_do_dono()
    {
        $donoEntitie = $this->getDonoEntitie();
        $donoCreated = $this->donoRepository->create($donoEntitie);

        $this->assertSame($donoEntitie->getId(), $donoCreated->id);
        $this->assertSame($donoEntitie->getNome(), $donoCreated->nome);
        $this->assertSame($donoEntitie->getTelefone(), $donoCreated->telefone);
    }

    public function test_create_dono_deve_retornar_instancia_da_model_dono()
    {
        $this->assertInstanceOf(
            Dono::class, 
            $this->donoRepository->create($this->getDonoEntitie())
        );
    }

    private function getDonoEntitie(): EntitieInterface
    {
        $dono = Dono::factory()->make();

        $donoEntitie = new EntitieDono;
        $donoEntitie->setId(Uuid::uuid4());
        $donoEntitie->setNome($dono->nome);
        $donoEntitie->setTelefone(new Telefone($dono->telefone));

        return $donoEntitie;
    }
}