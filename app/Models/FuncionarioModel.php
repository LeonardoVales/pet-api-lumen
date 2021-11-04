<?php

namespace App\Models;

use App\Entities\FuncionarioEntity;

class FuncionarioModel extends AbstractModel
{
    protected $table = 'funcionario';
    public string $entityClass = FuncionarioEntity::class;
    protected $fillable = ['id', 'nome'];
}