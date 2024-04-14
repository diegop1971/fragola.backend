<?php

namespace src\frontoffice\Stock\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EloquentStockModel extends Model
{
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
