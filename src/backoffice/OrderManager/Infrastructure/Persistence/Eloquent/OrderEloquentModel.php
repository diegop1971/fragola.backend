<?php

namespace src\backoffice\OrderManager\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\OrderStatus\Infrastructure\Persistence\Eloquent\OrderStatusEloquentModel;

class OrderEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'orders';

    protected $fillable = [
        'id',
        'order_status_id',
        'description',
        'enabled',
    ];

    public function orderStatusType(): BelongsTo
    {
        return $this->belongsTo(OrderStatusEloquentModel::class, 'order_status_id');
    }
}
