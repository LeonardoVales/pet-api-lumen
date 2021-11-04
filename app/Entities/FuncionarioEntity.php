<?php

namespace App\Entities;

class FuncionarioEntity extends EntityAbstract
{
    private ?string $nome;

    public function setNome(?string $nome): void
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id ?? null,
            'nome' => $this->nome,

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