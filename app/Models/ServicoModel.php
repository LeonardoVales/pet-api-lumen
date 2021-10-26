<?php

namespace App\Models;

use App\Entities\ServicoEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicoModel extends AbstractModel
{
    protected $table = 'servico';
    public string $entityClass = ServicoEntity::class;

    protected $fillable = [
        'id',
        'nome'
    ];
}