<?php

declare(strict_types=1);

namespace src\backoffice\OrderManager\Application\Find;

use Illuminate\Support\Facades\Log;
use src\backoffice\OrderManager\Domain\Interfaces\IOrderManagerRepository;


class OrdersGet
{
    private $repository;

    public function __construct(IOrderManagerRepository $repository,)
    {
        $this->repository = $repository;
    }

    public function __invoke(): ?array
    {
        $orders = $this->repository->searchAll();

        return $orders;
    }
}
