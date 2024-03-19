<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;
use src\frontoffice\Customers\Infrastructure\Persistence\Eloquent\CustomerEloquentModel;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stock = [
            [
                'first_name' => 'Anonymous First Name',
                'last_name' => 'Anonymous Last Name',
                'email' => 'anonymous@gmail.com',
                'email_verified_at' => null,
                'password' => 'passwordficticio123456789',
                'remember_token' => null,
            ],
        ];

        foreach ($stock as $stockItem) {
            $uuid = RamseyUuid::random();
            CustomerEloquentModel::create([
                'id' => $uuid,
                'first_name' => $stockItem['first_name'],
                'last_name' => $stockItem['last_name'],
                'email' => $stockItem['email'],
                'email_verified_at' => $stockItem['email_verified_at'],
                'password' => $stockItem['password'],
                'remember_token' => $stockItem['remember_token'],
            ]);
        }
    }
}
