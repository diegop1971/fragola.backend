<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Delete;

use Illuminate\Support\Facades\Log;
use src\backoffice\Products\Domain\ProductRepository;

final class ProductDeleter
{

    public function __construct(private ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        $this->repository->delete($id);
    }
}
