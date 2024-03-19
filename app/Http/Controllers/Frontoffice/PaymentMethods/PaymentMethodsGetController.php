<?php

namespace App\Http\Controllers\Frontoffice\PaymentMethods;

use Throwable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use src\frontoffice\PaymentMethods\Application\Find\PaymentMethodsGet;
use src\backoffice\Shared\Domain\Interfaces\IBackOfficeErrorMappingService;

class PaymentMethodsGetController extends Controller
{
    private $backOfficeErrorMappingService;

    public function __construct(IBackOfficeErrorMappingService $backOfficeErrorMappingService)
    {
        //$this->middleware('auth');
        $this->backOfficeErrorMappingService = $backOfficeErrorMappingService;
    }

    public function __invoke(PaymentMethodsGet $paymentMethodsGet): JsonResponse
    {
        try {
            $title = 'Payment Methods List';
            $paymentMethodsList = $paymentMethodsGet->__invoke();

            return response()->json([
                'title' => $title,
                'paymentMethodsList' => $paymentMethodsList,
            ]);
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
