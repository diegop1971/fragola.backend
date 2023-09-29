<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPricesHistoryEloquentModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

class ProductPricesEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $table = 'product_prices';

    protected $fillable = [
        'id',
        'id_product',
        'price',
        'discount_percentage',
    ];

    public function productPrices(): BelongsTo
    {
        return $this->belongsTo(ProductEloquentModel::class);
    }

    public function productPricesHistory(): HasMany
    {
        return $this->hasMany(ProductPricesHistoryEloquentModel::class);
    }
}
