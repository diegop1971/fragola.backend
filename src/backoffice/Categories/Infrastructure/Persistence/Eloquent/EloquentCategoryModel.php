<?php

namespace src\backoffice\Categories\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

class EloquentCategoryModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'enabled',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(ProductEloquentModel::class);
    }
}
