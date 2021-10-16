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

    public function test_create_deve_retornar_a_entidade_com_os_dados_do_animal()
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

    public function test_create_deve_retornar_instancia_da_model_animal()
    {
        $animalEntity = $this->getFakeAnimalEntity();
        
        $animalCreated = $this->animalRepository->create($animalEntity);

        $this->assertInstanceOf(
            EntityAbstract::class,
            $animalCreated
        );
    }

    public function test_deve_atualizar_os_dados_do_animal()
    {
        $animalEntity = $this->getFakeAnimalEntity();
        
        $animalCreatedOld = $this->animalRepository->create($animalEntity);
        
        $animalForUpdate = $this->getFakeAnimalEntity();
        $animalForUpdate->setId($animalCreatedOld->getId());

        $animalUpdated = $this->animalRepository->update($animalForUpdate);
        
        $this->assertEquals($animalUpdated->getId(), $animalCreatedOld->getId());
        $this->assertEquals($animalUpdated->getIdDono(), $animalCreatedOld->getIdDono());
        $this->assertNotEquals($animalUpdated->getNome(), $animalCreatedOld->getNome());
        
    }

    public function teste_update_deve_retornar_entidade_animal()
    {
        $animalEntity = $this->getFakeAnimalEntity();
        
        $animalCreatedOld = $this->animalRepository->create($animalEntity);
        
        $animalForUpdate = $this->getFakeAnimalEntity();
        $animalForUpdate->setId($animalCreatedOld->getId());

        $animalUpdated = $this->animalRepository->update($animalForUpdate);

        $this->assertInstanceOf(EntityAbstract::class, $animalUpdated);
    }

    public function test_deve_retornar_true_ao_deletar()
    {
        $animalModel = Animal::factory()->create([
            'id_dono' => $this->donoEntity->getId()
        ]);
        $animalEntity = $animalModel->getEntity();
        
        $this->assertTrue(
            $this->animalRepository->delete($animalEntity->getId())
        );
        
    }

    public function test_soft_delete()
    {
        $animalModel = Animal::factory()->create([
            'id_dono' => $this->donoEntity->getId()
        ]);
        $animalEntity = $animalModel->getEntity();

        $this->animalRepository->delete($animalEntity->getId());

        $this->notSeeInDatabase('animal',[
            'id' => $animalEntity->getId(),
            'deleted_at' => null
        ]);
    }

    public function test_deve_listar_todos_os_animais()
    {
        Animal::factory()->count(15)->create([
            'id_dono' => $this->donoEntity->getId()
        ]);
        
        $animais = $this->animalRepository->all();

        $this->assertCount(15, $animais);         
    }

    public function test_deve_listar_todos_os_animais_com_seus_donos()
    {
        Animal::factory()->count(1)->create([
            'id_dono' => $this->donoEntity->getId()
        ]);

        $animais = $this->animalRepository->all();
        
        $this->assertInstanceOf(Dono::class, $animais[0]->dono);        
    }

    private function getFakeAnimalEntity(): EntityAbstract
    {
        $animalModel = Animal::factory()->makeOne();
        $animalEntity = $animalModel->getEntity();
        $animalEntity->setIdDono($this->donoEntity->getId());

        return $animalEntity;
    }
}