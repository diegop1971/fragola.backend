<?php

namespace src\backoffice\OrderStatusTypes\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\OrderManager\Infrastructure\Persistence\Eloquent\OrderEloquentModel;

class OrderStatusTypeEloquentModel extends Model
{
    use HasFactory;

    protected $table = 'order_status_types';

    protected $fillable = [
        'status_type_name',
        'description',
        'enabled',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(OrderEloquentModel::class);
    }
}
