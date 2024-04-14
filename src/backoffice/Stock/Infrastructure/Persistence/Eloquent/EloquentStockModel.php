<?php

namespace src\backoffice\Stock\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

class EloquentStockModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'stock';

    protected $fillable = [
        'id', 
        'product_id',                         
        'physical_quantity', 
        'system_quantity',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductEloquentModel::class, 'product_id');
    }
}
