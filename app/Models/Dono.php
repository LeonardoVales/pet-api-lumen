<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dono extends Model
{
    public $incrementing = false;

    protected $table = 'dono';

    protected $fillable = [
        'nome',
        'telefone',
    ];

}