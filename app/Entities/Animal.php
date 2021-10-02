<?php 

namespace App\Entities;

use App\Entities\EntitieInterface;
use App\ValueObjects\Especie;

class Animal extends EntitieAbstract implements EntitieInterface
{
    private string $nome;
    private int $idade;
    private Especie $especie;
    private string $raca;
    private string $id_dono;

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setIdade(int $idade): void
    {
        $this->idade = $idade;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }

    public function setEspecie(Especie $especie): void
    {
        $this->especie = $especie;
    }

    public function getEspecie(): string
    {
        return $this->especie;
    }

    public function setRaca(string $raca): void
    {
        $this->raca = $raca;
    }

    public function getRaca(): string
    {
        return $this->raca;
    }

    public function setIdDono(string $id_dono): void
    {
        $this->id_dono = $id_dono;
    }

    public function getIdDono(): string
    {
        return $this->id_dono;
    }

    public function toArray(): array
    {
        $animalArray = get_object_vars($this);
        unset($animalArray['especie']);

        return array_merge(
            ['especie' => $this->getEspecie],
            $animalArray
        );
    }

}