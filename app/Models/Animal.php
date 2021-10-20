<?php

namespace App\Models;

use App\Entities\Animal as EntityAnimal;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Ramsey\Collection\Map\AbstractMap;

class Animal extends AbstractModel
{
    use SoftDeletes;

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

    public function dono()
    {
        return $this->hasOne('App\Models\Dono', 'id', 'id_dono');
    }
}