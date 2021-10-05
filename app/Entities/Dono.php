<?php

namespace App\Entities;

use App\Entities\EntityInterface;
use App\ValueObjects\Telefone;

class Dono extends EntityAbstract implements EntityInterface
{
    private string $nome;
    private Telefone $telefone;

    // public function __construct(
    //     protected ?string $id = null,
    //     private string $nome,
    //     private Telefone $telefone
    // )
    // {
        
    // }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
        // return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setTelefone(Telefone $telefone)
    {
        
        $this->telefone = $telefone;
        // return $this;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function toArray(): array
    {
        $donoArray = get_object_vars($this);
        unset($donoArray['telefone']);
        
        return array_merge(
            ['telefone' => $this->getTelefone()],
            $donoArray
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id ?? null,
            'nome' => $this->getNome(),
            'telefone' => $this->getTelefone()
        ];
    }    

    public static function fromArray(array $params)
    {
        // return new self(
        //     id: $params['id'] ?? null,
        //     nome: $params['nome'],
        //     telefone: new Telefone($params['telefone'])
        // );
        
        $entity = new self();
        
        if (isset($params['id'])) {            
            $entity->setId($params['id']);
        }
        
        $entity->setNome($params['nome']);
        $entity->setTelefone(new Telefone($params['telefone']));

        return $entity;

        // return new self()->setNome($params['nome']);
                
    }

}