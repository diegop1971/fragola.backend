<?php

namespace src\frontoffice\StockMovements\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EloquentStockMovementModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'stock_movements';

    protected $fillable = [
        'id', 
        'product_id',                         
        'movement_type_id', 
        'system_quantity', 
        'physical_quantity',
        'date', 
        'notes', 
        'enabled',
    ];
}
