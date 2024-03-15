<?php

namespace src\frontoffice\PaymentMethods\Infrastructure;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
