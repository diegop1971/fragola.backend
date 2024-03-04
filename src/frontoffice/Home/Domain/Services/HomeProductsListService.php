<?php

declare(strict_types=1);

namespace src\frontoffice\Home\Domain\Services;

use src\frontoffice\Stock\Domain\Interfaces\StockRepositoryInterface;
use src\frontoffice\Home\Domain\Interfaces\HomeProductsRepositoryInterface;

class HomeProductsListService
{
    private $homeProductRepository;
    private $stockRepository;

    public function __construct(HomeProductsRepositoryInterface $homeProductRepository, StockRepositoryInterface $stockRepository)
    {
        $this->homeProductRepository = $homeProductRepository;
        $this->stockRepository = $stockRepository;
    }

    public function getHomeProductsFilteredByStock(): ?array
    {
        $products = $this->homeProductRepository->getHomeProducts();
        $stockList = $this->stockRepository->groupAndCountStockByProductId();

        $filteredProducts = array_filter($products, function ($product) use ($stockList) {
            $totalQuantity = 0;

            foreach ($stockList as $stock) {
                if ($stock->id === $product['id']) {
                    $totalQuantity = $stock->total_quantity;
                    break;
                }
            }
            // revisar esta regla que la modifiqué para que funcione pero no sirve?
            return $totalQuantity > 0;
        });

        $filteredProducts = array_map(function ($product) use ($stockList) {
            foreach ($stockList as $stock) {
                if ($stock->id === $product['id']) {
                    $product['total_quantity'] = $stock->total_quantity;
                    break;
                }
            }
            return $product;
        }, $filteredProducts);

        return array_values($filteredProducts);
    }
}
