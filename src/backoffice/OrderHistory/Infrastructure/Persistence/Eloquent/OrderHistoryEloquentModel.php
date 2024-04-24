<?php

namespace src\backoffice\OrderHistory\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\OrderManager\Infrastructure\Persistence\Eloquent\OrderEloquentModel;
use src\backoffice\OrderStatus\Infrastructure\Persistence\Eloquent\OrderStatusEloquentModel;

class OrderHistoryEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'orders_histories';

    protected $fillable = [
        'id',
        'id_order',
        'id_order_status',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(OrderEloquentModel::class, 'id_order');
    }

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatusEloquentModel::class, 'id_order_status');
    }
}
