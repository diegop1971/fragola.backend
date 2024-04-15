<?php

namespace src\frontoffice\OrderStatus\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\Orders\Infrastructure\Persistence\Eloquent\OrderEloquentModel;
use src\frontoffice\PaymentMethods\Infrastructure\Persistence\Eloquent\PaymentMethodEloquentModel;

class OrderStatusEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'order_status';

    protected $fillable = [
        'id',
        'name',
        'short_name',
        'description',
        'enabled',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(OrderEloquentModel::class);
    }

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethodEloquentModel::class, 'initial_order_status_id');
    }
}
