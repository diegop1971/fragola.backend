<?php

namespace src\frontoffice\Cart\Infrastructure\Persistence\Session;

use Illuminate\Support\Facades\Log;
use src\frontoffice\Cart\Domain\Cart;
use src\frontoffice\Cart\Domain\ICartSessionManager;
use src\frontoffice\Cart\Domain\Interfaces\ICartRepository;
use src\frontoffice\Products\Application\Find\ProductFinder;

class CartRepository implements ICartRepository
{
    private $sessionManager;
    private $sessionCartItems = [];
    private $cartItems = [];
    private $item;
    private $flag;

    public function __construct(ICartSessionManager $sessionManager, private ProductFinder $productFind)
    {
        $this->sessionManager = $sessionManager;
    }

    public function searchAll(string $keyName): ?array
    {
        if (!Session()->exists($keyName)) {
            $sessionCartItems = [];
        } else {
            $sessionCartItems = $this->sessionManager->getKeySessionData($keyName);
        }
        
        return $sessionCartItems;
    }
    
    public function update(Cart $cart): void
    {
        $productId = $cart->productId()->value();
        $productQty = $cart->productQty()->value();

        $product = $this->productFind->__invoke($productId);

        $this->item = [
            'productId' => $product['id'],
            'productName' => $product['name'],
            'productDescription' => $product['description'],
            'productQty' => $productQty,
            'productUnitPrice' => round($product['price'], 2)
        ];
        
        // NOTA IMPORTANTE:  TENER EN CUENTA QUE LA KEY 'cart' PUEDE EXISTIR INCLUSO CON EL CARRITO VACIO, ANALIZAR ESO!!!!
        if (!session()->exists('cart')) {
            array_push($this->cartItems, $this->item);
            $this->sessionManager->putDataInKeySession('cart', $this->cartItems);
        } else {
            $this->sessionCartItems = $this->sessionManager->getKeySessionData('cart');

            foreach ($this->sessionCartItems as $sessionCartItem) {
                if (in_array($this->item['productId'], $sessionCartItem)) {
                    $cant = $sessionCartItem['productQty'] + $productQty;

                    $sessionCartItem = array_replace($sessionCartItem, [
                        'productId' => $product['id'],
                        'productName' => $product['name'],
                        'productDescription' => $product['description'],
                        'productQty' => $cant,
                        'productUnitPrice' => round($product['price'], 2)
                    ]);
                    $this->flag = true;
                }
                array_push($this->cartItems, $sessionCartItem);
            }
            if (!$this->flag) {
                array_push($this->cartItems, $this->item);
            }

            $this->sessionManager->putDataInKeySession('cart', $this->cartItems);
        }
    }

    public function deleteCart($keyName): void
    {
        $this->sessionManager->deleteKey($keyName);
    }
}
