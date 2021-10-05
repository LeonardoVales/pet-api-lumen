<?php

namespace App\Models;

use App\Entities\Animal as EntityAnimal;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Ramsey\Collection\Map\AbstractMap;

class Animal extends AbstractModel
{
    use HasFactory;

    protected $table = 'animal';
    public string $entityClass = EntityAnimal::class;

    protected $fillable = [
        'id',
        'nome',
        'idade',
        'especie',
        'raca',
        'id_dono'
    ];

}