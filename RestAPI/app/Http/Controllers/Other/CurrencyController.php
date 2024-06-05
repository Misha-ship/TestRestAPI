<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CurrencyServiceInterface;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    protected CurrencyServiceInterface $currencyService;

    public function __construct(CurrencyServiceInterface $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function __invoke(): JsonResponse
    {
        $exchangeRates = $this->currencyService->getExchangeRates();
        return response()->json($exchangeRates);
    }
}
