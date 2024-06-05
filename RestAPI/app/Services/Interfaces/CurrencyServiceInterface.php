<?php

namespace App\Services\Interfaces;

interface CurrencyServiceInterface
{
    public function getExchangeRates(): array;
}
