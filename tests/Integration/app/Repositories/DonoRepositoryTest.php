<?php

use App\Entities\Dono as EntityDono;
use App\Entities\EntityAbstract;
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
        
        $this->donoRepository = app(DonoRepositoryInterface::class);
    }

    public function test_deve_retornar_a_entidade_com_os_dados_do_dono()
    {
        $modelDono = Dono::factory()->makeOne();
        $entityDono = $modelDono->getEntity();

        $donoCreated = $this->donoRepository->create($entityDono);
        
        $this->assertNotNull($donoCreated->getId());
        $this->assertEquals($entityDono->getNome(), $donoCreated->getNome());
        $this->assertEquals($entityDono->getTelefone(), $donoCreated->getTelefone());        
    }

    public function test_create_dono_deve_retornar_instancia_da_model_dono()
    {
        $modelDono = Dono::factory()->makeOne();
        $entityDono = $modelDono->getEntity();

        $donoCreated = $this->donoRepository->create($entityDono);

        $this->assertInstanceOf(
            EntityAbstract::class,
            $donoCreated
        );
    }
}