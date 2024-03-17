<?php

namespace src\frontoffice\OrderStatus\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\OrderManager\Infrastructure\Persistence\Eloquent\OrderEloquentModel;

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
}
