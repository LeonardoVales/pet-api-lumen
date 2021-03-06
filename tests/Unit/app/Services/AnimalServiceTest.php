<?php

namespace Tests\Unit\App\Services;

use App\Entities\EntityAbstract;
use App\Exceptions\AnimalNotFoundException;
use App\Exceptions\DonoNotFoundException;
use App\Models\Animal;
use App\Models\Dono;
use App\Repositories\AnimalRepository;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\Repositories\DonoRepository;
use App\Services\AnimalService;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Ramsey\Uuid\Uuid;
use InvalidArgumentException;
use TestCase;

class AnimalServiceTest extends TestCase
{
    use DatabaseMigrations;

    private EntityAbstract $animalEntity;
    private EntityAbstract $donoEntity;
    private AnimalRepositoryInterface $animalRepository;
    private DonoRepositoryInterface $donoRepositoryMock;
    private $animalService;

    protected function setUp(): void
    {
        parent::setUp();

        $animalModel = Animal::factory()->makeOne();
        $this->animalEntity = $animalModel->getEntity();
                
        $donoModel = Dono::factory()->makeOne();
        $this->donoEntity = $donoModel->getEntity();

        $this->animalEntity->setId(Uuid::uuid4());
        $this->donoEntity->setId(Uuid::uuid4());
        $this->animalEntity->setIdDono($this->donoEntity->getId()); 

        // Lembrar de passar o with também !!!!
        // Certificar que um determinado método será chamado !!
        $this->animalRepository = $this->createMock(AnimalRepository::class);
        $this->animalRepository->method('create')->willReturn($this->animalEntity);
        $this->animalRepository->method('update')->willReturn($this->animalEntity);
        $this->animalRepository->method('delete')->willReturn(true);

        $this->donoRepositoryMock = $this->createMock(DonoRepository::class);        
       
    }

    public function test_deve_retornar_uma_excecao_se_o_animal_nao_existir_ao_atualizar()
    {
        $this->expectException(AnimalNotFoundException::class);
        $this->expectExceptionMessage('O animal não foi encontrado');

        $this->animalRepository->method('findEntity')->willReturn(null);
        $this->donoRepositoryMock->method('findEntity')->willReturn($this->donoEntity);
        
        $animalService = new AnimalService(
            $this->animalRepository,
            $this->donoRepositoryMock
        );
        
        $animalService->update(
            $this->animalEntity->jsonSerialize(),
            'kjlij435435lkj'
        );        
    }

    public function test_deve_retornar_uma_excecao_se_o_dono_do_animal_nao_existir_ao_cadastrar()
    {
        $this->expectException(DonoNotFoundException::class);
        $this->expectExceptionMessage('O dono não foi encontrado');
                
        $this->donoRepositoryMock->method('findEntity')->willReturn(null);

        $animalService = new AnimalService(
            $this->animalRepository, 
            $this->donoRepositoryMock
        );

        $animalService->create(
            $this->animalEntity->jsonSerialize(),
            $this->animalEntity->getId()
        ); 
    }

    public function test_deve_retornar_uma_excecao_se_o_dono_do_animal_nao_existir_ao_atualizar()
    {        
        $this->expectException(DonoNotFoundException::class);
        $this->expectExceptionMessage('O dono não foi encontrado');

        $this->animalRepository->method('findEntity')->willReturn($this->animalEntity);
        $this->donoRepositoryMock->method('findEntity')->willReturn(null);                

        $animalService = new AnimalService(
            $this->animalRepository,
            $this->donoRepositoryMock
        );

        $animalService->update(
            $this->animalEntity->jsonSerialize(),
            $this->animalEntity->getId()
        );        
    }

    public function teste_deve_retornar_instancia_entidade_animal()
    {        
        $this->donoRepositoryMock->method('findEntity')->willReturn($this->donoEntity);        
        
        $animalService = new AnimalService(
            $this->animalRepository, 
            $this->donoRepositoryMock
        );
    
        $animalCreated = $animalService->create(
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

    public function test_deve_retornar_excecao_se_o_animal_nao_existir_ao_deletar()
    {
        $this->expectException(AnimalNotFoundException::class);
        $this->expectExceptionMessage('O animal não foi encontrado');       

        $this->animalRepository->method('findModel')->willReturn(null);

        $animalService = new AnimalService(
            $this->animalRepository, 
            $this->donoRepositoryMock
        );
        
        $animalService->delete('99999999');
    }

    public function test_deve_retornar_excecao_se_o_animal_nao_existir_ao_consultar()
    {
        $this->expectException(AnimalNotFoundException::class);
        $this->expectExceptionMessage('O animal não foi encontrado');       

        $this->animalRepository->method('findModel')->willReturn(null);

        $animalService = new AnimalService(
            $this->animalRepository, 
            $this->donoRepositoryMock
        );

        $animalService->findById('99999999999');
    }

    public function test_deve_retornar_instancia_entidade_animal_ao_consultar()
    {
        $animalModel = Animal::factory()->makeOne();
        $animalEntity = $animalModel->getEntity();

        $this->animalRepository->method('findModel')->willReturn($animalModel);
        $this->animalRepository->method('find')->willReturn($animalEntity);

        $animalService = new AnimalService(
            $this->animalRepository, 
            $this->donoRepositoryMock
        );

        $animalFind = $animalService->findById($animalEntity->getId());

        $this->assertInstanceOf(
            EntityAbstract::class,
            $animalFind
        );
    }
}