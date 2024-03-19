<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\StockSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CustomerSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\PaymentMethodsSeeder;
use Database\Seeders\StockMovementsSeeder;
use Database\Seeders\StockMovementsTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'id' => Str::uuid()->toString(),
            'name' => 'Diego Puccio',
            'email' => 'usuario.prueba@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(StockMovementsTypeSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(StockMovementsSeeder::class);
        $this->call(PaymentMethodsSeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
