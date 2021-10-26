<?php

namespace App\Entities;

use App\Entities\EntityInterface;
use App\ValueObjects\Telefone;

class Dono extends EntityAbstract
{
    private ?string $nome;
    private ?Telefone $telefone;

    public function setNome(?string $nome)
    {
        $this->nome = $nome;        
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setTelefone(?Telefone $telefone)
    {
        $this->telefone = $telefone;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id ?? null,
            'nome' => $this->getNome(),
            'telefone' => $this->getTelefone(),

            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'deleted_at' => $this->getDeletedAt()
        ];
    }    

    public static function fromArray(array $params)
    {
        $entity = new self();
        
        if (isset($params['id'])) {            
            $entity->setId($params['id']);
        }
        
        $entity->setNome($params['nome']);
        $entity->setTelefone(new Telefone($params['telefone']));

        if (isset($params['created_at'])) {
            $entity->setCreatedAt($params['created_at']);
        }
        
        if (isset($params['updated_at'])) {
            $entity->setUpdatedAt($params['updated_at']);
        }
        
        if (isset($params['deleted_at'])) {
            $entity->setDeletedAt($params['deleted_at']);
        }

        return $entity;                
    }

}