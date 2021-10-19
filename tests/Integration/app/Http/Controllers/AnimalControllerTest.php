<?php

use App\Entities\EntityAbstract;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Models\Animal;
use App\Models\Dono;

class AnimalControllerTest extends TestCase
{
    use DatabaseMigrations;

    private EntityAbstract $animalEntity;

    protected function setUp(): void
    {
        parent::setUp();

        $donoModel = Dono::factory()->create();
        $animalModel = Animal::factory()->makeOne();
            
        $this->animalEntity = $animalModel->getEntity();
        $this->animalEntity->setIdDono($donoModel->id);
    }

    public function test_create_deve_retornar_status_201()
    {        
        $request = $this->post(
            '/animal', $this->animalEntity->jsonSerialize()
        );
        
        $request->assertResponseStatus(201);
    }

    public function test_deve_cadastrar_o_animal_no_banco_de_dados()
    {
        $request = $this->post(
            '/animal', $this->animalEntity->jsonSerialize()
        );

        $request->seeInDatabase('animal', [
            'nome' => $this->animalEntity->getNome(),
            'idade' => $this->animalEntity->getIdade(),
            'especie' => $this->animalEntity->getEspecie(),
            'raca' => $this->animalEntity->getRaca(),
            'id_dono' => $this->animalEntity->getIdDono()
        ]);
    }

    public function test_update_deve_retornar_status_204()
    {
        $donoModel = Dono::factory()->create();
        $animal = Animal::factory()->create([
            'id_dono' => $donoModel->id
        ]);

        $request = $this->put(
            '/animal/'.$animal->id, 
            $this->animalEntity->jsonSerialize()
        );

        $request->assertResponseStatus(204);
    }

    public function test_deve_atualizar_os_dados_do_animal() 
    {
        $donoModel = Dono::factory()->create();
        $animal = Animal::factory()->create([
            'id_dono' => $donoModel->id
        ]);

        $request = $this->put(
            '/animal/'.$animal->id, 
            $this->animalEntity->jsonSerialize()
        );

        $request->seeInDatabase('animal', [
            'nome' => $this->animalEntity->getNome(),
            'idade' => $this->animalEntity->getIdade(),
            'especie' => $this->animalEntity->getEspecie(),
            'raca' => $this->animalEntity->getRaca(),
            'id_dono' => $this->animalEntity->getIdDono()
        ]);
    }

    public function test_deve_deletar_o_animal()
    {
        $donoModel = Dono::factory()->create();
        $animal = Animal::factory()->create([
            'id_dono' => $donoModel->id
        ]);

        $request = $this->delete('/animal/'.$animal->id);

        $request->assertResponseStatus(204);
        $request->notSeeInDatabase('animal', [
            'id' => $animal->id,
            'deleted_at' => null
        ]);
    }
    
    public function test_deve_retornar_um_animal_pelo_id()
    {
        $donoModel = Dono::factory()->create();
        $animal = Animal::factory()->create([
            'id_dono' => $donoModel->id
        ]);

        $result = $this->get('/animal/'.$animal->id);
        $result->seeStatusCode(200);
        $result->seeJsonStructure([
            'id', 'nome', 'idade', 'especie', 
            'raca', 'id_dono', 'created_at',
            'updated_at', 'deleted_at'
        ]);
    }

    public function test_deve_listar_todos_os_animais()
    {
        $donoModel = Dono::factory()->create();
        Animal::factory()->count(5)->create([
            'id_dono' => $donoModel->id
        ]);

        $result = $this->get('/animal');

        $result->seeStatusCode(200);
        $result->seeJsonStructure([
            '*' => [
                'id', 'nome', 'idade', 'especie', 
                'raca', 'id_dono', 'created_at',
                'updated_at', 'deleted_at'
            ]
        ]);
    }
}