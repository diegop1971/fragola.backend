<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use src\backoffice\Categories\Infrastructure\Persistence\Eloquent\EloquentCategoryModel;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Ropa',
                'enabled' => true,
            ],
            [
                'name' => 'Accesorios',
                'enabled' => true,
            ],
            [
                'name' => 'Calzado',
                'enabled' => true,
            ],
        ];

        foreach ($categories as $categoryData) { 
            $uuid = RamseyUuid::random();
            if (!EloquentCategoryModel::where('id', $uuid)->exists()) {
                EloquentCategoryModel::create([
                    'id' => $uuid,
                    'name' => $categoryData['name'],
                    'enabled' => $categoryData['enabled'],
                ]);
            }
        }
    }
}
