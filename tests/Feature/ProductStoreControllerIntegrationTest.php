<?php

namespace Tests\Feature\Backoffice\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductStoreControllerIntegrationTest extends TestCase
{
    //use RefreshDatabase;

    public function test_it_creates_a_product_and_returns_success_response()
    {
        // Arrange
        $data = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'description_short' => 'Test Short Description',
            'price' => 10.99,
            'category_id' => 1,
            'low_stock_alert' => 1,
            'low_stock_threshold' => 6,
            'enabled' => 1,
        ];

        // Act
        $response = $this->post(route('backoffice.products.store'), $data);
        //$response = $this->postJson(route('backoffice.products.store'), $data);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => "Producto dado de alta correctamente",
            'code' => 200
        ]);

        // You might also want to assert something about the database state
        // For example, check if the product was actually created in the database
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }
}
