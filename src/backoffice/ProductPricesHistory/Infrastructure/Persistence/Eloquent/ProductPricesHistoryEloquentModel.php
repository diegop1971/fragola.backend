<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPricesEloquentModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPricesHistoryEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'product_price_history';

    protected $fillable = [
        'id',
        'id_product',
        'price',
        'discount_percentage',
    ];

    public function productPrices(): BelongsTo
    {
        return $this->belongsTo(ProductPricesEloquentModel::class, 'id_product');
    }
}
