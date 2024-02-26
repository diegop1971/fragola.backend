<?php

namespace src\backoffice\Products\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPricesEloquentModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\Categories\Infrastructure\Persistence\Eloquent\EloquentCategoryModel;

class ProductEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'description',
        'description_short',
        'price',
        'category_id',
        'product_price_uuid',
        'low_stock_threshold',
        'low_stock_alert',
        'out_of_stock',
        'enabled',
    ];

    public function productPrices()
    {
        return $this->hasOne(ProductPricesEloquentModel::class, 'product_price_uuid', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(EloquentCategoryModel::class, 'category_id');
    }
}
