<?php

use App\Entities\ServicoEntity;
use App\Models\Dono;
use App\Models\ServicoModel;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class ServicoEntityTest extends TestCase
{
    private string $id;
    private string $nome;

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = Uuid::uuid4();
        $this->nome = 'Banho';        
        $this->created_at = Carbon::now()->format(DATE_ISO8601);
        $this->updated_at = Carbon::tomorrow()->format(DATE_ISO8601);
        $this->deleted_at = null;
    }

    public function test_deve_retornar_instanacia_entidade_servico_com_inputs()
    {
        $servicoEntity = new ServicoEntity;
        $servicoEntity->setId($this->id);
        $servicoEntity->setNome($this->nome);
        $servicoEntity->setCreatedAt($this->created_at);
        $servicoEntity->setUpdatedAt($this->updated_at);
        $servicoEntity->setDeletedAt(null);

        $this->assertEquals($this->id, $servicoEntity->getId());
        $this->assertEquals($this->nome, $servicoEntity->getNome());
        $this->assertEquals($this->created_at, $servicoEntity->getCreatedAt());
        $this->assertEquals($this->updated_at, $servicoEntity->getUpdatedAt());
        $this->assertEquals($this->deleted_at, $servicoEntity->getDeletedAt());
    }

    public function test_deve_retornar_nova_instancia_a_partir_do_array()
    {
        $servicoEntity = ServicoEntity::fromArray([
            'id' => $this->id,
            'nome' => $this->nome,
        ]);

        $this->assertEquals($this->id, $servicoEntity->getId());
        $this->assertEquals($this->nome, $servicoEntity->getNome());        
    }

    public function test_array_from_json_serialize()
    {
        $servico = ServicoModel::factory()->makeOne();    
        $servicoEntity = $servico->getEntity();

        $this->assertEmpty(
            array_diff($servico->toArray(), $servicoEntity->jsonSerialize())     
        );
    }
}