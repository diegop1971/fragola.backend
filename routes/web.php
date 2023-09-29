<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontoffice\Cart\CartGetController;
use App\Http\Controllers\Frontoffice\Cart\AddToCartController;
use App\Http\Controllers\Frontoffice\Cart\DeleteCartController;
use App\Http\Controllers\Frontoffice\Product\ProductController;
use App\Http\Controllers\Backoffice\Stock\StockUpdateController;
use App\Http\Controllers\Backoffice\Products\ProductGetController;
use App\Http\Controllers\Frontoffice\Cart\AsyncShowCartController;
use App\Http\Controllers\Backoffice\Products\ProductEditController;
use App\Http\Controllers\Backoffice\Products\ProductsGetController;
use App\Http\Controllers\Frontoffice\Cart\CartItemDeleteController;
use App\Http\Controllers\Backoffice\Products\ProductStoreController;
use App\Http\Controllers\Backoffice\Categories\CategoryGetController;
use App\Http\Controllers\Backoffice\Products\ProductCreateController;
use App\Http\Controllers\Backoffice\Products\ProductDeleteController;
use App\Http\Controllers\Backoffice\Products\ProductUpdateController;
use App\Http\Controllers\Backoffice\Stock\GetStockMovementController;
use App\Http\Controllers\Frontoffice\Cart\CartItemQuantityController;
use App\Http\Controllers\Backoffice\Categories\CategoryEditController;
use App\Http\Controllers\Backoffice\Stock\EditStockMovementController;
use App\Http\Controllers\Backoffice\Stock\GetStockMovementsController;
use App\Http\Controllers\Backoffice\Categories\CategoriesGetController;
use App\Http\Controllers\Backoffice\Categories\CategoryStoreController;
use App\Http\Controllers\Backoffice\Stock\StoreStockMovementController;
use App\Http\Controllers\Backoffice\Categories\CategoryCreateController;
use App\Http\Controllers\Backoffice\Categories\CategoryDeleteController;
use App\Http\Controllers\Backoffice\Categories\CategoryUpdateController;
use App\Http\Controllers\Backoffice\Stock\CreateStockMovementController;
use App\Http\Controllers\Backoffice\Stock\DeleteStockMovementController;
use App\Http\Controllers\Frontoffice\Home\GetProductsCardListController;
use App\Http\Controllers\Frontoffice\Home\GetHomeOnSaleProductsController;
use App\Http\Controllers\Frontoffice\ProductList\ProductListGetController;
use App\Http\Controllers\Frontoffice\Home\GetHomeFeaturedProductsController;
use App\Http\Controllers\Frontoffice\Home\GetHomeBestsellingProductsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
        return view('welcome');
    });

/*
|--------------------------------------------------------------------------
| FRONTOFFICE
|--------------------------------------------------------------------------
| Acá van unicamente las rutas referentes al frontend
|
*/

Route::get('/', GetProductsCardListController::class)->name('home');

Route::get('/best-selling-products', GetHomeBestsellingProductsController::class)->name('selling-products');

Route::get('/featured-products', GetHomeFeaturedProductsController::class)->name('featured-products');

Route::get('/on-sale-products', GetHomeOnSaleProductsController::class)->name('on-sale-products');

Route::get('/products-list', ProductListGetController::class)->name('products-list');

Route::get('/product', ProductController::class)->name('product');

Route::get('/shop-in-style', function () {
        return view('shopinstyle');
});    

Route::prefix('cart')->group(function () {
        Route::get('/axios', AsyncShowCartController::class);
        Route::get('/delete-item/{itemId}', CartItemDeleteController::class);
        Route::post('/add-to-cart', AddToCartController::class)->name('cart.add-to-cart');
        Route::post('/cart-item-qty', CartItemQuantityController::class)->name('cart.cart-item-qty');
        Route::group(['prefix' => 'mi-carrito'], function () {
                Route::get('/', CartGetController::class)->name('my-cart');               
                Route::get('/deletecart', DeleteCartController::class)->name('cart.delete-cart');
        });
});

Route::prefix('Purchase')->group(function () {
        Route::group(['prefix' => 'tu-compra'], function () {
                Route::post('/complete-purchase', 'completePuchaseController@completePurchase')
                ->name('purchase.complete-purchase');
                Route::post('/purchase-store', 'completePuchaseController@purchaseStore')
                ->name('purchase.purchase-store');
                Route::get('/purchase-complete', function () {
                return view('purchaseComplete');
                })->name('purchase-complete');
        });
});

/*
|--------------------------------------------------------------------------
| BACKOFFICE
|--------------------------------------------------------------------------
| Acá van unicamente las rutas referentes al backend
|
*/

//Auth::routes();

Route::prefix('products')->group(function () 
{
        Route::get('/', ProductsGetController::class)->name('backoffice.products.index');
        Route::get('/{id}', ProductGetController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.products.show');
        Route::get('/create', ProductCreateController::class)->name('backoffice.products.create');
        Route::post('/store', ProductStoreController::class)->name('backoffice.products.store');
        Route::get('/{id}/edit', ProductEditController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.products.edit');
        Route::put('/update', ProductUpdateController::class)->name('backoffice.products.update');
        Route::delete('/{id}', ProductDeleteController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.products.destroy');
        //Route::get('/{slug}', ProductGetBySlugController::class)->where('slug', '[A-Za-z0-9\-\/]+')->name('backoffice.product.show');
});

Route::prefix('categories')->group(function () {
        Route::get('/', CategoriesGetController::class)->name('backoffice.categories.index');
        Route::get('/{id}', CategoryGetController::class)
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
                ->name('backoffice.categories.destroy');
        //Route::get('/{slug}', ProductGetBySlugController::class)->where('slug', '[A-Za-z0-9\-\/]+')->name('backoffice.product.show');
});

Route::prefix('stock')->group(function () {
        Route::get('/', GetStockMovementsController::class)->name('backoffice.stock.index');
        Route::get('/{id}', GetStockMovementController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.stock.show');
        Route::get('/create', CreateStockMovementController::class)->name('backoffice.stock.create');
        Route::post('/store', StoreStockMovementController::class)->name('backoffice.stock.store');
        Route::get('/{id}/edit', EditStockMovementController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.stock.edit');
        Route::put('/update', StockUpdateController::class)->name('backoffice.stock.update');
        Route::delete('/{id}', DeleteStockMovementController::class)
                ->where('id', '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}')
                ->name('backoffice.stock.destroy');
        //Route::get('/{slug}', ProductGetBySlugController::class)->where('slug', '[A-Za-z0-9\-\/]+')->name('backoffice.product.show');
});

