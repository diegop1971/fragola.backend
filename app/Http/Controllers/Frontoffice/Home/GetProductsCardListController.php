<?php

namespace App\Http\Controllers\Frontoffice\Home;

use Throwable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use src\frontoffice\Home\Application\Find\GetHomeProducts;
use src\backoffice\Shared\Domain\Interfaces\IBackofficeErrorMappingService;

class GetProductsCardListController extends Controller
{
    private $backofficeErrorMappingService;

    public function __construct(IBackofficeErrorMappingService $backofficeErrorMappingService)
    {
        //$this->middleware('auth');
        $this->backofficeErrorMappingService = $backofficeErrorMappingService;
    }

    public function __invoke(GetHomeProducts $homeProducts):JsonResponse
    {
        try {
            $homeProductsData = $homeProducts->__invoke();

            $title = 'Card List Products';

            $responseData = [
                'title' => $title,
                'homeProducts' => $homeProductsData,
            ];
            return response()->json($responseData);
        } catch (Throwable $e) {
            $mappedError = $this->backofficeErrorMappingService->mapToHttpCode($e->getCode(), $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $mappedError['message'],
                'details' => null,
                'code' => $mappedError['http_code'],
            ], $mappedError['http_code']);
        }
    }
}
