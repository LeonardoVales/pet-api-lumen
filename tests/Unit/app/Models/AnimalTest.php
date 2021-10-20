<?php

namespace Tests\Unit\App\Models;

use App\Entities\EntityAbstract;
use App\Models\Animal;
use TestCase;

class AnimalTest extends TestCase
{
    public function test_deve_retornar_entidade_a_partir_da_model()
    {
        $animalModel = Animal::factory()->makeOne();

        $this->assertInstanceOf(EntityAbstract::class, $animalModel->getEntity());        
    }
}