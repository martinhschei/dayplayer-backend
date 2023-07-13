<?php

namespace Dayplayer\BackendModels\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Dayplayer\BackendModels\Payment;
use Dayplayer\BackendModels\Production;
use Dayplayer\BackendModels\Helpers\PriceCalculator;

class PaymentsManager
{
    public static function createPaymentsForProduction(Production $production, $paymentMethod)
    {
        $price = new PriceCalculator(
            $production->start_date,
            $production->end_date,
            $production->departments()->count(),
        );
        
        $priceOption = $price->getOptionsForPaymentMethod($paymentMethod);
        
        collect($priceOption['payment_dates'])->each(function ($paymentDate) use ($priceOption, $production, $paymentMethod) {
            $production->payments()->create([
                'method' => $paymentMethod,
                'status' => Payment::PAYMENT_STATUS_PENDING,
                'amount' => Arr::get($priceOption, 'price'),
                'due_date' => Carbon::parse($paymentDate)->format('Y-m-d'),
            ]);
        });
    }

    public static function getFullPrice(Production $production)
    {
        return $production->payments()->sum('amount');
    }
}