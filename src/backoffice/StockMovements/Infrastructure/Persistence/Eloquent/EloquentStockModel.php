<?php

namespace src\backoffice\StockMovements\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;
use src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeModel;

class EloquentStockModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'stock_movements';

    protected $fillable = [
        'id', 
        'product_id',                         
        'movement_type_id', 
        'quantity', 
        'date', 
        'notes', 
        'enabled',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductEloquentModel::class, 'product_id');
    }

    public function stockMovementType(): BelongsTo
    {
        return $this->belongsTo(EloquentStockMovementTypeModel::class, 'movement_type_id');
    }
}
