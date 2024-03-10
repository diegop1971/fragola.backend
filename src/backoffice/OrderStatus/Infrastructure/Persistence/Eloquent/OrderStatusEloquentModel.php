<?php

namespace src\backoffice\OrderStatus\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\OrderManager\Infrastructure\Persistence\Eloquent\OrderEloquentModel;

class OrderStatusEloquentModel extends Model
{
    use HasFactory;

    protected $table = 'order_status';

    protected $fillable = [
        'id',
        'name',
        'description',
        'enabled',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(OrderEloquentModel::class);
    }
}
