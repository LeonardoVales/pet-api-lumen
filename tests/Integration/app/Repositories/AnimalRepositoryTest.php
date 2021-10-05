<?php

namespace Testes\Unit\App\Repositories;

use App\Entities\EntityAbstract;
use App\Models\Animal;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Models\Dono;
use TestCase;

class AnimalRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private AnimalRepositoryInterface $animalRepository;
    private EntityAbstract $donoEntity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->animalRepository = app(AnimalRepositoryInterface::class);

        $donoModel = Dono::factory()->create();
        $this->donoEntity = $donoModel->getEntity();
                
    }

    public function test_deve_retornar_a_entidade_com_os_dados_do_animal()
    {
        
        $animalModel = Animal::factory()->makeOne();
        $animalEntity = $animalModel->getEntity();
        $animalEntity->setIdDono($this->donoEntity->getId());
        
        $animalCreated = $this->animalRepository->create($animalEntity);

        $this->assertNotNull($animalCreated->getId());
        $this->assertEquals($animalEntity->getNome(), $animalCreated->getNome());
        $this->assertEquals($animalEntity->getIdade(), $animalCreated->getIdade());
        $this->assertEquals($animalEntity->getEspecie(), $animalCreated->getEspecie());
        $this->assertEquals($animalEntity->getRaca(), $animalCreated->getRaca());
        $this->assertEquals($animalEntity->getIdDono(), $animalCreated->getIdDono());

    }

    public function test_deve_retornar_instancia_da_model_animal()
    {
        $animalModel = Animal::factory()->makeOne();
        $animalEntity = $animalModel->getEntity();
        $animalEntity->setIdDono($this->donoEntity->getId());
        
        $animalCreated = $this->animalRepository->create($animalEntity);

        $this->assertInstanceOf(
            EntityAbstract::class,
            $animalCreated
        );
    }
}