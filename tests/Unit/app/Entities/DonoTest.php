<?php

use App\Entities\Dono;
use App\Models\Dono as ModelDono;
use App\ValueObjects\Telefone;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class DonoTest extends TestCase
{
    private string $id;
    private string $nome;
    private string $telefone;

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = Uuid::uuid4();
        $this->nome = 'Vales';
        $this->telefone = '31986623642';
        $this->created_at = Carbon::now()->format(DATE_ISO8601);
        $this->updated_at = Carbon::tomorrow()->format(DATE_ISO8601);
        $this->deleted_at = null;

    }

    public function test_deve_retornar_instancia_entidade_com_inputs()
    {
        $entityDono = new Dono;
        $entityDono->setId($this->id);
        $entityDono->setNome($this->nome);
        $entityDono->setTelefone(new Telefone($this->telefone));
        $entityDono->setCreatedAt($this->created_at);
        $entityDono->setUpdatedAt($this->updated_at);
        $entityDono->setDeletedAt(null);

        $this->assertEquals($this->id, $entityDono->getId());
        $this->assertEquals($this->nome, $entityDono->getNome());
        $this->assertEquals($this->telefone, $entityDono->getTelefone());
        $this->assertEquals($this->created_at, $entityDono->getCreatedAt());
        $this->assertEquals($this->updated_at, $entityDono->getUpdatedAt());
        $this->assertEquals($this->deleted_at, $entityDono->getDeletedAt());
    }

    public function test_deve_retornar_nova_instancia_a_partir_do_array()
    {
        $entityDono = Dono::fromArray([
            'id' => $this->id,
            'nome' => $this->nome,
            'telefone' => $this->telefone,
        ]);

        $this->assertEquals($this->id, $entityDono->getId());
        $this->assertEquals($this->nome, $entityDono->getNome());
        $this->assertEquals($this->telefone, $entityDono->getTelefone());
    }

    public function test_array_from_json_serialize()
    {
        $dono = ModelDono::factory()->makeOne();        
        $donoEntity = $dono->getEntity();

        $this->assertEmpty(
            array_diff($dono->toArray(), $donoEntity->jsonSerialize())     
        );
    }
}