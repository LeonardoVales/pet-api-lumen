<?php

use App\Entities\EntityAbstract;
use App\Models\Animal;
use App\Repositories\AnimalRepository;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Services\AnimalService;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Ramsey\Uuid\Uuid;

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

        $this->animalService = new AnimalService($this->animalRepository);

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