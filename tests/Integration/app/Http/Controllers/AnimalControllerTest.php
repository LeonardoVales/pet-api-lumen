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
}