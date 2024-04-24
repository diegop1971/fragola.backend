<?php

declare(strict_types=1);

namespace src\backoffice\OrderStatus\Application\Find;

use src\backoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;

final class OrdersStatusGet
{
    private $repository;

    public function __construct(IOrderStatusRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $categories = $this->repository->searchAll();
        
        return $categories;
    }
}
