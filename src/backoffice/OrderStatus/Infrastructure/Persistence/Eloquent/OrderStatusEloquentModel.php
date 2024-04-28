<?php

namespace src\backoffice\OrderStatus\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\OrderManager\Infrastructure\Persistence\Eloquent\OrderEloquentModel;
use src\backoffice\OrderHistory\Infrastructure\Persistence\Eloquent\OrderHistoryEloquentModel;

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

    public function orderHistories(): HasMany
    {
        return $this->hasMany(OrderHistoryEloquentModel::class);
    }
}
