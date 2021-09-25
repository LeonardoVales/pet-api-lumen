<?php

namespace App\Entities;

abstract class EntitieAbstract
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}