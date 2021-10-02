<?php

namespace App\Entities;

use Ramsey\Uuid\Uuid;

class EntitieAbstract
{
    protected string $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}