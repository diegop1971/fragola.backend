<?php

namespace src\frontoffice\Stock\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EloquentStockModel extends Model
{
    use HasUuids;

    protected $table = 'stock_movements';

    protected $fillable = [
        
    ];

    /*public function product(): BelongsTo
    {
        return $this->belongsTo(ProductEloquentModel::class, 'product_id');
    }

    public function stockMovementType(): BelongsTo
    {
        return $this->belongsTo(EloquentStockMovementTypeModel::class, 'movement_type_id');
    }*/
}
