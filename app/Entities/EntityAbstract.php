<?php

namespace App\Entities;

use Ramsey\Uuid\Uuid;

class EntityAbstract
{
    protected ?string $id;
    // protected ?string $created_at;
    // protected ?string $updated_at;

    // public function __construct()
    // {
    //     $this->id = Uuid::uuid4();
    // }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {        
        return $this->id;
    }

    // public function setCreatedAt(): ?string
    // {
    //     $this->created_at = $
    // }

    // public function getCreatedAt(): ?string
    // {
    //     return $this->created_at;
    // }

    // public function getUpdatedAt(): ?string
    // {
    //     return $this->updated_at;
    // }
}