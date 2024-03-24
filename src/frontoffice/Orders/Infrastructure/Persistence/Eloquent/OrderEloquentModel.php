<?php

namespace src\frontoffice\Orders\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\Customers\Infrastructure\Persistence\Eloquent\CustomerEloquentModel;
use src\frontoffice\OrderStatus\Infrastructure\Persistence\Eloquent\OrderStatusEloquentModel;
use src\frontoffice\OrdersDetails\Infrastructure\Persistence\Eloquent\OrderDetailEloquentModel;
use src\frontoffice\PaymentMethods\Infrastructure\Persistence\Eloquent\PaymentMethodEloquentModel;

class OrderEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'orders';

    protected $fillable = [
        'id',
        'customer_id',
        'payment_method_id',
        'order_status_id',
        'items_quantity',
        'total_paid',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(CustomerEloquentModel::class, 'customer_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethodEloquentModel::class, 'payment_method_id');
    }

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatusEloquentModel::class, 'order_status_id');
    }

    public function OrderDetails(): HasMany
    {
        return $this->hasMany(OrderDetailEloquentModel::class);
    }
}
