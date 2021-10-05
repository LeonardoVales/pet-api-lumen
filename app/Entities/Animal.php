<?php 

namespace App\Entities;

use App\Entities\EntityInterface;
use App\ValueObjects\Especie;

class Animal extends EntityAbstract
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id ?? null,
            'nome' => $this->getNome(),
            'idade' => $this->getIdade(),
            'especie' => $this->getEspecie(),
            'raca' => $this->getRaca(),
            'id_dono' => $this->getIdDono(),
        ];
    }

    public static function fromArray(array $params)
    {
        $entity = new self();

        if (isset($params['id'])) {
            $entity->setId($params['id']);
        }

        $entity->setNome($params['nome']);
        $entity->setIdade($params['idade']);
        $entity->setEspecie(new Especie($params['especie']));
        $entity->setRaca($params['raca']);
        $entity->setIdDono($params['id_dono']);

        return $entity;
    }



}