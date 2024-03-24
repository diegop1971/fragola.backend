<?php

namespace src\frontoffice\Customers\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\Orders\Infrastructure\Persistence\Eloquent\OrderEloquentModel;

class CustomerEloquentModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'customers';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(OrderEloquentModel::class);
    }
}
