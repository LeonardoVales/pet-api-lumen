<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    public $incrementing = false;

    protected $table = 'animal';

    protected $fillable = [
        'id',
        'nome',
        'idade',
        'especie',
        'raca',
        'id_dono'
    ];

}