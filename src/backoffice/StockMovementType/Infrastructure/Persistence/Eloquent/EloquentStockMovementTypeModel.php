<?php

namespace src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\Stock\Infrastructure\Persistence\Eloquent\EloquentStockModel;

class EloquentStockMovementTypeModel extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $table = 'stock_movement_types';

    protected $fillable = [
        'id',
        'movement_type',                         
        'description', 
        'stock_impact',
        'is_positive', 
        'enabled',
    ];
    
    public function stockMovements(): HasMany
    {
        return $this->hasMany(EloquentStockModel::class);
    }
}
