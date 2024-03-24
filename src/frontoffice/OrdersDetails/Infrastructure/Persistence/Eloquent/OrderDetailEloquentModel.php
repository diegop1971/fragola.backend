<?php

namespace src\frontoffice\OrdersDetails\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\Orders\Infrastructure\Persistence\Eloquent\OrderEloquentModel;
use src\frontoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;

class OrderDetailEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'order_details';

    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(OrderEloquentModel::class, 'order_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductEloquentModel::class, 'product_id');
    }
}
