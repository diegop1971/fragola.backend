<?php

namespace src\frontoffice\StockMovementType\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EloquentStockMovementTypeModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'stock_movement_types';

    protected $fillable = [
        'id',
        'movement_type',
        'short_name',
        'description',
        'stock_impact',
        'is_positive',
        'enabled',
    ];
}
