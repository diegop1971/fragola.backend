<?php

namespace App\Http\Controllers\Frontoffice\Home;

use Throwable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use src\frontoffice\Home\Application\Find\GetHomeProducts;
use src\frontoffice\Shared\Domain\Interfaces\IFrontOfficeErrorMappingService;

class GetProductsCardListController extends Controller
{
    private $frontOfficeErrorMappingService;

    public function __construct(IFrontOfficeErrorMappingService $frontOfficeErrorMappingService)
    {
        //$this->middleware('auth');
        $this->frontOfficeErrorMappingService = $frontOfficeErrorMappingService;
    }

    public function __invoke(GetHomeProducts $homeProducts):JsonResponse
    {
        try {
            $title = 'Card List Products';
            $homeProductsData = $homeProducts->__invoke();

            $responseData = [
                'title' => $title,
                'homeProducts' => $homeProductsData,
            ];
            return response()->json($responseData);
        } catch (Throwable $e) {
            $mappedError = $this->frontOfficeErrorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $mappedError['message'],
                //'message' => 'Error occurred at ' . $e->getFile() . ' line ' . $e->getLine() . ': ' . $e->getMessage(),
                'details' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }

    private function processPayment() {
        // Obtener el método de pago seleccionado por el cliente desde el frontend
        $paymentMethod = 'wallet';

        // Resolver la instancia correcta del contenedor de servicios basada en el método de pago
        $paymentGateway = app(PaymentGateway::class . ucfirst($paymentMethod));

        // Verificar si la instancia se resolvió correctamente
        if(!$paymentGateway) {
            return response()->json(['error' => 'Método de pago no válido'], 400);
        }

        // Procesar el pago utilizando la instancia de la forma de pago correcta
        $amount = 100; // Obtener el monto del pago
        $paymentGateway->processPayment($amount);

        // Retornar una respuesta adecuada al cliente
        return response()->json(['message' => 'Pago procesado correctamente'], 200);
    }
}
