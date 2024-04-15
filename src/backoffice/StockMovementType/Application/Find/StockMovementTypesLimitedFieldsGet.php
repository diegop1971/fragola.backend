<?php

declare(strict_types=1);

namespace src\backoffice\StockMovementType\Application\Find;

use src\backoffice\StockMovementType\Domain\IStockMovementTypeRepository;

final class StockMovementTypesLimitedFieldsGet
{
    private $repository;

    public function __construct(IStockMovementTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $stocks = $this->repository->getAllEnabledStockMovementTypesNamesAndIDs();

        return $stocks;
    }
}
