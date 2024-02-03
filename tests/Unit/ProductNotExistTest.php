<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use src\backoffice\Products\Domain\ProductNotExist;

class ProductNotExistTest extends TestCase
{
    public function test_example(): void
    {
        $productId = '742d72a0-915e-11d9-a07b-c4346b041272';

        $this->expectException(ProductNotExist::class);
        $this->expectExceptionMessage("El producto con el código 742d72a0-915e-11d9-a07b-c4346b041272 no existe");

        throw new ProductNotExist($productId);
    }
}
