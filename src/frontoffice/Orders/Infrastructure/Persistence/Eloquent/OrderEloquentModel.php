<?php

namespace src\frontoffice\Orders\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /*public function orders(): HasMany
    {
        return $this->hasMany(OrderEloquentModel::class);
    }*/
}
