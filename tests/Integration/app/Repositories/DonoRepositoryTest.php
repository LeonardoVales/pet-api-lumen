<?php

use App\Entities\Dono as EntityDono;
use App\Entities\EntityInterface;
use App\Models\Dono;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Repositories\DonoRepository;
use App\ValueObjects\Telefone;
use Laravel\Lumen\Testing\DatabaseMigrations;

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
        $donoEntity = $this->getDonoEntity();
        $donoCreated = $this->donoRepository->create($donoEntity);

        $this->assertSame($donoEntity->getId(), $donoCreated->id);
        $this->assertSame($donoEntity->getNome(), $donoCreated->nome);
        $this->assertSame($donoEntity->getTelefone(), $donoCreated->telefone);
    }

    public function test_create_dono_deve_retornar_instancia_da_model_dono()
    {
        $this->assertInstanceOf(
            Dono::class, 
            $this->donoRepository->create($this->getDonoEntity())
        );
    }

    private function getDonoEntity(): EntityInterface
    {
        $dono = Dono::factory()->make();

        $donoEntity = new EntityDono;
        $donoEntity->setNome($dono->nome);
        $donoEntity->setTelefone(new Telefone($dono->telefone));

        return $donoEntity;
    }
}