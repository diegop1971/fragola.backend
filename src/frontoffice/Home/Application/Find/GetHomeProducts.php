<?php

declare(strict_types=1);

namespace src\frontoffice\Home\Application\Find;

use src\frontoffice\Home\Domain\Services\HomeProductsListService;

final class GetHomeProducts
{
    public function __construct(private HomeProductsListService $homeProductList) 
    {
    }

    public function __invoke(): array
    {
        $homeProducts = $this->homeProductList->getHomeProductsFilteredByStock();

        return $homeProducts;
    }
}
