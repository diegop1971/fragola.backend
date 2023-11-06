<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontoffice\Cart\CartGetController;
use App\Http\Controllers\Frontoffice\Cart\AddToCartController;
use App\Http\Controllers\Frontoffice\Cart\DeleteCartController;
use App\Http\Controllers\Frontoffice\Cart\AsyncShowCartController;
use App\Http\Controllers\Frontoffice\Cart\CartItemDeleteController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Frontoffice\Cart\CartItemQuantityController;
use App\Http\Controllers\Backoffice\Stock\DeleteStockMovementController;
use App\Http\Controllers\Frontoffice\Home\GetProductsCardListController;

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
    Route::get('/get-cart-products', AsyncShowCartController::class)->middleware('auth:sanctum');
    Route::delete('/delete-item/{itemId}', CartItemDeleteController::class);
    Route::post('/add-to-cart', AddToCartController::class)->name('cart.add-to-cart');
    Route::post('/cart-item-qty', CartItemQuantityController::class)->name('cart.cart-item-qty');
});

Route::get('/productsCardList', GetProductsCardListController::class)->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| BACKOFFICE
|--------------------------------------------------------------------------
| Rutas relacionadas al backend
|
*/

Route::delete('/stock/{id}', DeleteStockMovementController::class);

