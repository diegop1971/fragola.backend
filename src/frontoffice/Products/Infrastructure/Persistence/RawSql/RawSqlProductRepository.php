<?php

declare(strict_types=1);

namespace src\frontoffice\Products\Infrastructure\Persistence\RawSql;

use Illuminate\Support\Facades\DB;
use src\frontoffice\Products\Domain\ProductRepository;

class RawSqlProductRepository implements ProductRepository
{
    public function searchAll(): ?array
    {        
        $products = DB::select('SELECT products.id, products.name, products.description, products.price, categories.name, products.enabled 
                                    FROM products 
                                    LEFT JOIN categories 
                                    ON products.category_id = categories.id 
                                    WHERE products.enabled != 0 
                                    ORDER BY products.id 
                                    LIMIT 50'
                                );

        $arrayProducts = json_decode(json_encode($products), true);
        
        return $arrayProducts;
    }

    public function search($id): ?array
    {
        $productStdObjet = DB::select('SELECT * FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE products.id = ' . $id);

        $product = ((array)$productStdObjet[0]);
        
        return $product;
    }

}
