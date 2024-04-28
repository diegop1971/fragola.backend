<?php

namespace App\Http\Controllers\Backoffice\Orders;

use Throwable;
use App\Http\Controllers\Controller;
use src\backoffice\OrderManager\Application\Find\OrdersGet;
use src\backoffice\OrderStatus\Application\Find\OrdersStatusGet;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;

class OrdersGetController extends Controller
{
    private $ordersGet;
    private $ordersStatusGet;
    private $backOfficeErrorMappingService;

    public function __construct(OrdersGet $ordersGet, OrdersStatusGet $ordersStatusGet, IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        $this->ordersGet = $ordersGet;
        $this->ordersStatusGet = $ordersStatusGet;
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke()
    {
        $title = 'Order Manager';

        try {
            $orders = $this->ordersGet->__invoke();

            $ordersStatus = $this->ordersStatusGet->__invoke();

            return response()->json([
                'title' => $title,
                'orders' => $orders,
                'ordersStatus' => $ordersStatus,
            ], 200);
        } catch (Throwable $e) {
            $mappedError = $this->backOfficeErrorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $mappedError['message'],
                'details' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
