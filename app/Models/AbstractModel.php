<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Entities\EntityAbstract;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

abstract class AbstractModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;
    public string $entityClass;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->id = Uuid::uuid4();
            $model->created_at = Carbon::now()->format(DATE_ISO8601);
        });
    }

    public function getEntity(): EntityAbstract
    {
        return call_user_func("{$this->entityClass}::fromArray", $this->toArray());
    }

}