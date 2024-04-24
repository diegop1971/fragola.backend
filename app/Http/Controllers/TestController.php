<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use src\backoffice\OrderManager\Application\Find\OrdersGet;

class TestController extends Controller
{
    private $ordersGet;

    public function __construct(OrdersGet $orderFinder)
    {
        $this->ordersGet = $orderFinder;    
    }

    public function index()
    {
        $orders = $this->ordersGet->__invoke();

        Log::info($orders);
    }
}
