<?php


use App\Entities\EntityAbstract;
use App\Models\Dono;
use App\Repositories\Contracts\DonoRepositoryInterface;
use App\ValueObjects\Telefone;
use Laravel\Lumen\Testing\DatabaseMigrations;

class DonoRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private DonoRepositoryInterface $donoRepository;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->donoRepository = app(DonoRepositoryInterface::class);
    }

    public function test_create_deve_retornar_a_entidade_com_os_dados_do_dono()
    {
        $modelDono = Dono::factory()->makeOne();
        $entityDono = $modelDono->getEntity();

        $donoCreated = $this->donoRepository->create($entityDono);
        
        $this->assertNotNull($donoCreated->getId());
        $this->assertEquals($entityDono->getNome(), $donoCreated->getNome());
        $this->assertEquals($entityDono->getTelefone(), $donoCreated->getTelefone());        
    }

    public function test_create_dono_deve_retornar_instancia_da_model_dono()
    {
        $modelDono = Dono::factory()->makeOne();
        $entityDono = $modelDono->getEntity();

        $donoCreated = $this->donoRepository->create($entityDono);

        $this->assertInstanceOf(
            EntityAbstract::class,
            $donoCreated
        );
    }

    public function test_deve_atualizar_os_dados_do_dono_exceto_id()
    {
        $donoEntityCreatedOld = $this->getFakeDonoEntity('create');

        $donoEntityUpdate = $this->getFakeDonoEntity('update');
        $donoEntityUpdate->setId($donoEntityCreatedOld->getId());
        $donoEntityUpdate->setTelefone(new Telefone('3167894532'));

        $donoUpdated = $this->donoRepository->update($donoEntityUpdate);
        
        $this->assertEquals($donoUpdated->getId(), $donoEntityCreatedOld->getId());
        $this->assertNotEquals($donoUpdated->getNome(), $donoEntityCreatedOld->getNome());
        $this->assertNotEquals($donoUpdated->getTelefone(), $donoEntityCreatedOld->getTelefone());
    }

    public function test_deve_retornar_entidade_dono_ao_atualizar()
    {
        $donoEntity = $this->getFakeDonoEntity('create');
        $donoEntityUpdated = $this->donoRepository->update($donoEntity);

        $this->assertInstanceOf(EntityAbstract::class, $donoEntityUpdated);
    }

    public function test_deve_retornar_true_ao_deletar()
    {
        $donoEntity = $this->getFakeDonoEntity('create');

        $this->assertTrue(
            $this->donoRepository->delete($donoEntity->getId())
        );
    }

    public function test_soft_delete()
    {
        $donoEntity = $this->getFakeDonoEntity('create');
        
        $this->donoRepository->delete($donoEntity->getId());

        $this->notSeeInDatabase('dono', [
            'id' => $donoEntity->getId(),
            'deleted_at' => null
        ]);
    }

    public function getFakeDonoEntity(string $action): EntityAbstract
    {
        if ($action == 'create') {
            $donoModel = Dono::factory()->create();
        } elseif ($action == 'update') {
            $donoModel = Dono::factory()->makeOne();
        }

        $donoEntity = $donoModel->getEntity();
        
        return $donoEntity;
    }
}