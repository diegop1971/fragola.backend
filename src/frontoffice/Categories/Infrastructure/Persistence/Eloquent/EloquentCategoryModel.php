<?php

namespace src\frontoffice\Categories\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

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
        return $this->hasMany(HomeProductEloquentModel::class);
    }
}
