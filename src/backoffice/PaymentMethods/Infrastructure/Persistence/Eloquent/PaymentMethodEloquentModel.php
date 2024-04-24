<?php

namespace src\backoffice\PaymentMethods\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\Orders\Infrastructure\Persistence\Eloquent\OrderEloquentModel;
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

    public function orders(): HasMany
    {
        return $this->hasMany(OrderEloquentModel::class);
    }
}
