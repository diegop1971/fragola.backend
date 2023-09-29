<?php

namespace src\backoffice\Categories\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

class EloquentCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'enabled',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(ProductEloquentModel::class);
    }
}
