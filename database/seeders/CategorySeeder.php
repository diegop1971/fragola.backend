<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use src\backoffice\Categories\Infrastructure\Persistence\Eloquent\EloquentCategoryModel;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Ropa',
            'Accesorios',
            'Calzado',
        ];

        foreach ($categories as $categoryName) {
            EloquentCategoryModel::create([
                                        'name' => $categoryName,
                                        'enabled' => true, 
                                    ]);
        }
    }
}
