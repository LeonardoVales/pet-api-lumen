<?php

use App\Models;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    public string $entityClass;
}