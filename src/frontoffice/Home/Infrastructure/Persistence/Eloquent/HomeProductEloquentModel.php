<?php

namespace src\frontoffice\Home\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\Categories\Infrastructure\Persistence\Eloquent\EloquentCategoryModel;

class HomeProductEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'category_id',
        'enabled',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EloquentCategoryModel::class, 'category_id');
    }
}
