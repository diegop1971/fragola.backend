<?php

namespace src\frontoffice\PaymentMethods\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\OrderStatus\Infrastructure\Persistence\Eloquent\OrderStatusEloquentModel;

class PaymentMethodEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'payment_methods';

    protected $fillable = [
        'id',
        'name',
        'description',
        'enabled',
    ];

    public function initialOrderStatus()
    {
        return $this->belongsTo(OrderStatusEloquentModel::class, 'initial_order_status_id');
    }
}
