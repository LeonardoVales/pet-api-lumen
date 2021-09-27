<?php

use App\Models\Dono;

class DonoRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_create_dono_deve_retornar_instancia_da_model_dono()
    {
        
        $teste = Dono::factory()->make();
        dd($teste);
    }
}