<?php

namespace Dayplayer\BackendModels\Helpers;

use Illuminate\Support\Arr;
use Dayplayer\BackendModels\Payment;
use Dayplayer\BackendModels\Production;
use Dayplayer\BackendModels\Helpers\PriceCalculator;

class PaymentsManager
{
    public static function createPaymentsForProduction(Production $production)
    {
        $price = new PriceCalculator(
            $production->start_date,
            $production->end_date,
            $production->departments()->count()
        );

        $priceOption = $price->getOptionsForPaymentMethod($production->payment_method);
        
        collect($priceOption['payment_dates'])->each(function ($paymentDate) use ($priceOption) {
            $production->payments()->create([
                'due_date' => $paymentDate,
                'method' => $prodution->payment_method,
                'status' => Payment::PAYMENT_STATUS_PENDING,
                'amount' => Arr::get($priceOption, 'price'),
            ]);
        });
    }
}