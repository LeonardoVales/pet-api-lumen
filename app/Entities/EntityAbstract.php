<?php

namespace App\Entities;

use Ramsey\Uuid\Uuid;

abstract class EntityAbstract
{
    protected ?string $id;
    protected ?string $created_at;
    protected ?string $updated_at;
    protected ?string $deleted_at;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {        
        return $this->id;
    }

    public function setCreatedAt(string $created_at = null): void
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at ?? null;
    }

    public function setUpdatedAt(string $updated_at = null): void
    {
        $this->updated_at = $updated_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at ?? null;
    }

    public function setDeletedAt(string $deleted_at = null): void
    {
        $this->deleted_at = $deleted_at;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deleted_at ?? null;
    }
}