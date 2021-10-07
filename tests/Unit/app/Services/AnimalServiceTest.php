<?php

namespace Tests\Unit\App\Services;

use App\Entities\EntityAbstract;
use App\Models\Animal;
use App\Repositories\AnimalRepository;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Services\AnimalService;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Ramsey\Uuid\Uuid;
use InvalidArgumentException;
use TestCase;

class AnimalServiceTest extends TestCase
{
    use DatabaseMigrations;

    private EntityAbstract $animalEntity;
    private AnimalRepositoryInterface $animalRepository;
    private $animalService;

    protected function setUp(): void
    {
        parent::setUp();

        $animalModel = Animal::factory()->makeOne();
        $this->animalEntity = $animalModel->getEntity();
        $this->animalEntity->setId(Uuid::uuid4());

        $this->animalRepository = $this->createMock(AnimalRepository::class);
        $this->animalRepository->method('create')->willReturn($this->animalEntity);
        $this->animalRepository->method('update')->willReturn($this->animalEntity);

        $this->animalService = new AnimalService($this->animalRepository);

    }

    public function test_deve_retornar_uma_excecao_se_o_animal_nao_existir_ao_atualizar()
    {
        $this->expectException(InvalidArgumentException::class);
        
        $this->animalService->update(
            $this->animalEntity->jsonSerialize(),
            'kjlij435435lkj'
        );        
    }

    public function test_deve_retornar_uma_excecao_se_o_dono_do_animal_nao_existir()
    {
        $this->expectException(InvalidArgumentException::class);
        
        $this->animalService->update(
            $this->animalEntity->jsonSerialize(),
            $this->animalEntity->getId()
        );        
    }

    public function teste_deve_retornar_instancia_entidade_animal()
    {
        $animalCreated = $this->animalService->create(
            $this->animalEntity->jsonSerialize()
        );
        
        $this->assertInstanceOf(
            EntityAbstract::class,
            $animalCreated
        );
    
        $this->assertEquals(
            $this->animalEntity->getId(),
            $animalCreated->getId()
        );

        $this->assertEquals(
            $this->animalEntity->getNome(),
            $animalCreated->getNome()
        );

        $this->assertEquals(
            $this->animalEntity->getIdade(),
            $animalCreated->getIdade()
        );

        $this->assertEquals(
            $this->animalEntity->getEspecie(),
            $animalCreated->getEspecie()
        );

        $this->assertEquals(
            $this->animalEntity->getRaca(),
            $animalCreated->getRaca()
        );

        $this->assertEquals(
            $this->animalEntity->getIdDono(),
            $animalCreated->getIdDono()
        );
    }
}