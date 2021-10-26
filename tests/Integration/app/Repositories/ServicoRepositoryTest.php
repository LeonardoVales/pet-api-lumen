<?php

use App\Models\ServicoModel;
use App\Repositories\Contracts\ServicoRepositoryInterface;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ServicoRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private ServicoRepositoryInterface $servicoRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->servicoRepository = app(ServicoRepositoryInterface::class);
    }

    public function test_deve_ser_possivel_criar_um_tipo_de_servico()
    {
        $servicoModel = ServicoModel::factory()->makeOne();
        $servicoEntity = $servicoModel->getEntity();

        $this->servicoRepository->create($servicoEntity);

        $this->assertDatabaseHas('servico', [
            'id' => $servicoEntity->getId(),
            'nome' => $servicoEntity->getNome()
        ]);

        // $this->assertDatabaseHas('servico', [
        //     // 'id' => $servicoEntity->getId(),
        //     'nome' => $servicoEntity->getNome()
        // ]);
    }
}