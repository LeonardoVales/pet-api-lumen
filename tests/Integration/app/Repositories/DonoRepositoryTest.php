<?php

// namespace Unit\app\Repositories;

use App\Entities\Dono as EntitiesDono;
use App\Entities\EntitieAbstract;
use App\Models\Dono;
use App\Repositories\DonoRepository;
use App\Services\DonoService;
use App\ValueObjects\Telefone;

// use Laravel\Lumen\Testing\TestCase;


class DonoRepositoryTest extends TestCase
{
    private EntitieAbstract $donoEntitie;
    private DonoService $donoService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->donoEntitie = new EntitiesDono;
        $this->donoEntitie->setNome('Leonardo Vales');
        $this->donoEntitie->setTelefone(new Telefone('31986623642'));

    }

    public function test_create_dono_deve_retornar_instancia_da_model_dono()
    {
        $donoRepository = new DonoRepository;

        $this->assertInstanceOf(
            Dono::class, 
            $donoRepository->create($this->donoEntitie)
        );
    }
}