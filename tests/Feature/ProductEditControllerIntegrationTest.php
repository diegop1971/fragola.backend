<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery\MockInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use src\backoffice\Products\Domain\ProductNotExist;
use src\backoffice\Products\Application\Find\ProductFinder;
use src\backoffice\Products\Application\Create\ProductCreator;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\EloquentProductRepository;

class ProductEditControllerIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_200_response_if_the_product_exists(): void
    {
        $this->mock(ProductCreator::class, function (MockInterface $mock) {
            

        });

        /*$this->mock(ProductCreator::class, function (MockInterface $mock) {
            $mock->shouldReceive('__invoke')->with('742d72a0-915e-11d9-a07b-c4346b041272')->andReturn(
                new EloquentProductRepository(
                    '04e0d91f-3f69-45cd-bcc0-3dca811723d9', //id
                    'Producto ficticio', // name
                    'Descripcion del producto ficticio', // description
                    'Descripcion short del producto ficticio', // description_short
                    '5000', // price
                    'true', // low_stock_alert
                    '50', // low_stock_threshold
                    '2', // category_id
                    'Ropa', // category_name
                    'true', // enabled


                )
            );
        });*/

        $response = $this->withoutMiddleware()->get(route('backoffice.products.edit', '742d72a0-915e-11d9-a07b-c4346b041272'));

        $response->assertStatus(200);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Producto actualizado correctamente',
            'code' => 200,
        ]);
    }

    public function test_it_returns_a_404_response_if_the_product_does_not_exist(): void
    {
        $this->mock(ProductFinder::class, function (MockInterface $mock) {
            $mock->shouldReceive('__invoke')
                ->with('742d72a0-915e-11d9-a07b-c4346b041272')
                ->andThrow(new ProductNotExist('742d72a0-915e-11d9-a07b-c4346b041272'));
        });

        $response = $this->withoutMiddleware()->get(route('backoffice.products.edit', '742d72a0-915e-11d9-a07b-c4346b041272'));

        $response->assertStatus(404);
        $response->assertJson([
            'success' => false,
            'message' => 'El producto con el código 742d72a0-915e-11d9-a07b-c4346b041272 no existe',
            'code' => 404,
        ]);
    }
}
