<?php

use App\Entities\Animal;
use App\ValueObjects\Especie;
use Ramsey\Uuid\Uuid;

class AnimalTest extends TestCase
{
    private string $id;
    private string $nome;
    private int $idade;
    private string $especie;
    private string $raca;
    private string $id_dono;

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = Uuid::uuid4();
        $this->nome = 'Pipoca';
        $this->idade = 8;
        $this->especie = 'Cachorro';
        $this->raca = 'Vira lata';
        $this->id_dono = Uuid::uuid4();
    }

    public function test_deve_retornar_instancia_entidade_com_inputs()
    {
        $entityAnimal = new Animal;
        $entityAnimal->setId($this->id);
        $entityAnimal->setNome($this->nome);
        $entityAnimal->setIdade($this->idade);
        $entityAnimal->setEspecie(new Especie($this->especie));
        $entityAnimal->setRaca($this->raca);
        $entityAnimal->setIdDono($this->id_dono);

        $this->assertEquals($this->id, $entityAnimal->getId());
        $this->assertEquals($this->nome, $entityAnimal->getNome());
        $this->assertEquals($this->idade, $entityAnimal->getIdade());
        $this->assertEquals($this->especie, $entityAnimal->getEspecie());
        $this->assertEquals($this->raca, $entityAnimal->getRaca());
        $this->assertEquals($this->id_dono, $entityAnimal->getIdDono());
    }

    public function test_deve_retornar_nova_instancia_a_partir_do_array()
    {
        $entityAnimal = Animal::fromArray([
            'id' => $this->id,
            'nome' => $this->nome,
            'idade' => $this->idade,
            'especie' => $this->especie,
            'raca' => $this->raca,
            'id_dono' => $this->id_dono,
        ]);

        $this->assertEquals($this->id, $entityAnimal->getId());
        $this->assertEquals($this->nome, $entityAnimal->getNome());
        $this->assertEquals($this->idade, $entityAnimal->getIdade());
        $this->assertEquals($this->especie, $entityAnimal->getEspecie());
        $this->assertEquals($this->raca, $entityAnimal->getRaca());
        $this->assertEquals($this->id_dono, $entityAnimal->getIdDono());
    }
}