<?php

namespace App\Models;

use App\Entities\Dono as EntityDono;

class Dono extends AbstractModel
{
    protected $table = 'dono';
    public string $entityClass = EntityDono::class;

    protected $fillable = [
        'id',
        'nome',
        'telefone',
    ];

}