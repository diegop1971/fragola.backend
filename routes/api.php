<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontoffice\Cart\AddToCartController;
use App\Http\Controllers\Frontoffice\Cart\AsyncShowCartController;
use App\Http\Controllers\Backoffice\Products\ProductEditController;
use App\Http\Controllers\Backoffice\Products\ProductsGetController;
use App\Http\Controllers\Frontoffice\Cart\CartItemDeleteController;
use App\Http\Controllers\Backoffice\Products\ProductStoreController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Backoffice\Products\ProductDeleteController;
use App\Http\Controllers\Backoffice\Products\ProductUpdateController;
use App\Http\Controllers\Backoffice\Stock\GetStockMovementController;
use App\Http\Controllers\Frontoffice\Cart\CartItemQuantityController;
use App\Http\Controllers\Backoffice\Stock\GetStockMovementsController;
use App\Http\Controllers\Backoffice\Categories\CategoriesGetController;
use App\Http\Controllers\Backoffice\Stock\StoreStockMovementController;
use App\Http\Controllers\Backoffice\Products\StockProductsGetController;
use App\Http\Controllers\Backoffice\Stock\CreateStockMovementController;
use App\Http\Controllers\Frontoffice\Home\GetProductsCardListController;
use App\Http\Controllers\Backoffice\Stock\GetStockListByProductIdController;
use App\Http\Controllers\Backoffice\StockMovementTypes\StockMovementTypesGetController;
use App\Http\Controllers\Backoffice\StockMovementTypes\StockMovementTypesLimitedFieldsGetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| FRONTOFFICE
|--------------------------------------------------------------------------
| Rutas relacionadas al frontend
|
*/

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('auth:sanctum');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
});

Route::prefix('cart')->group(function () {
        Route::get('/get-cart-products', AsyncShowCartController::class);
        Route::delete('/delete-item/{itemId}', CartItemDeleteController::class);
        Route::post('/add-to-cart', AddToCartController::class)->name('cart.add-to-cart');
        Route::post('/cart-item-qty', CartItemQuantityController::class)->name('cart.cart-item-qty');
});

Route::get('/productsCardList', GetProductsCardListController::class);

/*
|--------------------------------------------------------------------------
| BACKOFFICE
|--------------------------------------------------------------------------
| Rutas relacionadas al backend
|
*/

Route::prefix('categories')->group(function () {
        Route::get('/', CategoriesGetController::class)->name('backoffice.categories.index');
        /*areRoute::get('/{id}', CategoryGetController::class)
            ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
            ->name('backoffice.categories.show');
    Route::get('/create', CategoryCreateController::class)->name('backoffice.categories.create');
    Route::post('/store', CategoryStoreController::class)->name('backoffice.categories.store');
    Route::get('/{id}/edit', CategoryEditController::class)
            ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
            ->name('backoffice.categories.edit');
    Route::put('/update', CategoryUpdateController::class)->name('backoffice.categories.update');
    Route::delete('/{id}', CategoryDeleteController::class)->name('backoffice.categories.destroy');
    Route::delete('/{id}', CategoryDeleteController::class)
            ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
            ->name('backoffice.categories.destroy');*/
});

Route::prefix('products')->group(function () {
        Route::get('/', ProductsGetController::class)->name('backoffice.products.index');
        Route::post('/store', ProductStoreController::class)->name('backoffice.products.store');
        Route::get('/{id}/edit', ProductEditController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.products.edit');
        Route::put('/update', ProductUpdateController::class)->name('backoffice.products.update');
        Route::delete('/{id}', ProductDeleteController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.products.destroy');
        Route::get('/product-list', StockProductsGetController::class);
});

Route::prefix('stock')->group(function () {
        Route::get('/', GetStockMovementsController::class)->name('backoffice.stock.index');

        Route::get('stocklistByProductId/{id}', GetStockListByProductIdController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.stock.showStockListByProductId');

        Route::get('/{id}', GetStockMovementController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.stock.show');
        Route::get('/create', CreateStockMovementController::class)->name('backoffice.stock.create');
        Route::post('/store', StoreStockMovementController::class)->name('backoffice.stock.store');
});

Route::prefix('stock-movement-types')->group(function () {
        Route::get('/', StockMovementTypesGetController::class)->name('backoffice.stock-movement-types.index');
        Route::get('/limited-fields-list', StockMovementTypesLimitedFieldsGetController::class);
});
