<?php

declare(strict_types=1);

namespace src\frontoffice\Home\Application\Find;

use src\frontoffice\Home\Domain\Services\HomeProductsListService;
use src\frontoffice\Home\Domain\Interfaces\HomeProductsRepositoryInterface;

final class GetHomeProducts
{
    private $homeProductsRepository;

    public function __construct(HomeProductsRepositoryInterface $homeProductsRepository) 
    {
        $this->homeProductsRepository = $homeProductsRepository;
    }

    public function __invoke()
    {
        $homeProducts = $this->homeProductsRepository->getHomeProducts();
        
        return $homeProducts;
    }
}
