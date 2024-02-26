<?php

namespace Tests\Feature\Backoffice\Products;

use Tests\TestCase;
use Mockery\MockInterface;
use Illuminate\Support\Facades\Log;
use src\Shared\Domain\Bus\Command\CommandBus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use src\backoffice\Products\Application\Create\CreateProductCommand;

class ProductStoreControllerIntegrationTest extends TestCase
{
    //use RefreshDatabase;

    private $commandBusMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->commandBusMock = $this->mock(CommandBus::class);
        $this->app->instance(CommandBus::class, $this->commandBusMock);  
    }

    public function test_it_creates_a_product_and_returns_success_response()
    {
        // Datos del producto a crear
        $productData = [
            //'742d72a0-915e-11d9-a07b-c4346b041272', //id
            'Producto ficticio', // name
            'Descripcion del producto ficticio', // description
            'Descripcion short del producto ficticio', // description_short
            5000, // price
            '2', // category_id
            '1', // low_stock_alert
            50, // low_stock_threshold
            '1', // enabled
        ];

        /*
        esto llega a CreateProductCommand
        [2024-02-03 13:18:40] testing.INFO: 742d72a0-915e-11d9-a07b-c4346b041272  
        [2024-02-03 13:19:24] testing.INFO: Producto ficticio  
        [2024-02-03 13:21:25] testing.INFO: Descripcion del producto ficticio  
        [2024-02-03 13:24:09] testing.INFO: Descripcion short del producto ficticio  
        [2024-02-03 13:24:42] testing.INFO: 5000  
        [2024-02-03 13:25:11] testing.INFO: 2  
        [2024-02-03 13:25:45] testing.INFO: 1  
        [2024-02-03 13:26:34] testing.INFO: 30  
        [2024-02-03 13:27:06] testing.INFO: 50  
        [2024-02-03 13:27:35] testing.INFO: 1  
        */

        // Simula que el comando se ejecuta correctamente
        /*$this->commandBusMock->shouldReceive('execute')
            ->with(new CreateProductCommand(...array_values($productData)))
            ->once();*/

        $this->commandBusMock->shouldReceive('execute')
            ->with(new CreateProductCommand(
                '742d72a0-915e-11d9-a07b-c4346b041272',
                ...array_values($productData)
            ))
            ->once();

        // Envía la petición POST al controlador
        $response = $this->postJson(route('backoffice.products.store'), $productData);
        // Comprueba la respuesta del controlador
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => "Producto dado de alta correctamente",
            'code' => 200
        ]);

        // Comprueba que el producto se haya creado en la base de datos
        $this->assertDatabaseHas('products', $productData);
    }
}
