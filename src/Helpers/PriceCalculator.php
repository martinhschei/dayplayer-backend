<?php

namespace Dayplayer\BackendModels\Helpers;

use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PriceCalculator
{
    private $price;
    private $endDate;
    private $startDate;
    private $departmentCount;
    
    public function __construct($startDate, $endDate, $departmentCount) 
    {
        $this->endDate = $endDate;
        $this->startDate = $startDate;
        $this->departmentCount = $departmentCount;

        $this->calculatePrice();
    }

    private function pricing()
    {
        return [
            'day' => 10,
            'department' => 10,
        ];
    }

    public function getPrices()
    {
        return
        [
            'base_price' => $this->price,
            'time' => [
                'calendar' => $this->productionDaysInCalendarTimes(),
                'text' => $this->explanation(),
            ],
            'options' => $this->options()
        ];
    }

    function generatePaymentDates($startDate, $endDate, $interval) 
    {
        $paymentDates = [];
        
        $start = Carbon::createFromFormat('Y-m-d', $startDate)->addDays(3);  // Add the 3-day buffer
        $end = Carbon::createFromFormat('Y-m-d', $endDate);

        $currentDate = $start;

        while ($currentDate->lte($end)) {
            $paymentDates[] = $currentDate->toDateString();
            $currentDate = $currentDate->addDays($interval);
            if ($currentDate->gt($end)) {
                $paymentDates[] = $end->toDateString();
                break;
            }
        }
    
        return $paymentDates;
    }
    
    private function options()
    {
        $options = [
            [
                'displayName' => 'Credit card',
                'value' => 'credit_card',
                'text' => "$ {$this->creditCardPrice()} paid now with credit card. {$this->discount()}% discount on base price.",
                'price' => $this->creditCardPrice(),
                'discount' => $this->discount(),
                'payments' => 1,
            ],
            $this->canPayWeekly() ? [
                'displayName' => 'Weekly',
                'value' => 'weekly',
                'text' => "$ {$this->weeklyPrice()} due every 7 days - {$this->productionDaysInCalendarTimes()['weeks']} payments",
                'discount' => 0,
                'payment_dates' => $this->generatePaymentDates($this->startDate, $this->endDate, 30),
                'price' => $this->weeklyPrice(),

                'payments' => $this->productionDaysInCalendarTimes()['weeks'],
            ]  : null,
            $this->canPayMonthly() ? [
                'displayName' => 'Monthly',
                'value' => 'monthly',
                'text' => "$ {$this->monthlyPrice()} due every 4 weeks - {$this->productionDaysInCalendarTimes()['months']} payments",
                'discount' => 0,
                'price' =>  $this->monthlyPrice(),
                'payment_dates' => $this->generatePaymentDates($this->startDate, $this->endDate, 30),
                'payments' => $this->productionDaysInCalendarTimes()['months'],
            ]  : null,
        ];
    
        return collect($options)->reject(function ($option) {
            return is_null($option);
        })->values();
    }
    

    private function weeklyPrice()
    {
        $result = $this->price / $this->productionDaysInCalendarTimes()['weeks'];
        return floor($result);
    }
    
    private function monthlyPrice()
    {
        $result = $this->price / $this->productionDaysInCalendarTimes()['months'];
        return floor($result);
    }
    
    private function creditCardPrice()
    {
        $result = $this->price * (100 - $this->discount()) / 100;
        return floor($result);
    }
    

    private function discount()
    {
        return 10;
    }

    private function explanation() 
    {
        $unit = "";
        $deps = "";
        $unitCount = 0;
        
        $productionDays = $this->productionDaysInCalendarTimes();
        $days = $productionDays['days'];
        $weeks = $productionDays['weeks'];
        $remainderDays = $days - ($weeks * 7);
        
        $formattedString = [];
        
        if ($days > 0 && $weeks == 0) {
            $formattedString[] = $remainderDays == 1 ? "{$remainderDays} day" : "{$remainderDays} days";
        }
        
        if ($weeks > 0) {
            $formattedString[] = $weeks == 1 ? "{$weeks} week" : "{$weeks} weeks";
            if ($remainderDays > 0) {
                $formattedString[] = $remainderDays == 1 ? "{$remainderDays} day" : "{$remainderDays} days";
            }
        }
        
        return implode(', ', $formattedString);
    }
    
    function canPayWeekly() 
    {
        $start_date = new DateTime($this->startDate);
        $end_date = new DateTime($this->endDate);
        $interval = $start_date->diff($end_date);
        return $interval->format('%a') > 14 ;
    }
    
    function canPayMonthly() 
    {
        $start_date = new DateTime($this->startDate);
        $end_date = new DateTime($this->endDate);
        $interval = $start_date->diff($end_date);
        return $interval->format('%a') > 30 ;
    }

    public function schedule() 
    {
        if ($this->paymentMethod == 'credit_card' && $this->canPayWeekly()) {
            return "$ {$this->discountPrice()} due now - {$this->discount()} discount";
        }
        
        if ($this->paymentMethod == 'credit_card' && !$this->canPayWeekly()) {
            return "Must be paid directly with credit card.";
        }
    
        if ($this->paymentMethod == 'monthly' && !$this->canPayMonthly()) {
            return "Must be paid directly with credit card.";
        }
        
        if ($this->paymentMethod == 'monthly' && $this->canPayMonthly()) {
            $perMonth = $this->monthlyPrice();
            
            if ($this->productionDaysInCalendarTimes()['months'] == 1) {
                return "$ {$perMonth} due in approx. 30 days";
            } else {
                return "$ {$perMonth} due approx. every 30 days - {$this->productionDaysInCalendarTimes()['months']} payments";
            }
        }
        
        if ($this->paymentMethod == 'weekly') {            
            if ($this->productionDaysInCalendarTimes()['weeks'] == 1) {
                return "$ {$this->weeklyPrice()} due in 7 days";
            } else {
                return "$ {$this->weeklyPrice()} due every 7 days - {$this->productionDaysInCalendarTimes()['weeks']} payments";
            }
        }
    }
    
    public function calculatePrice() 
    {
        $start = Carbon::createFromFormat('Y-m-d', $this->startDate);
        $end = Carbon::createFromFormat('Y-m-d', $this->endDate);
        $days = $end->diffInDays($start);
        
        Log::info($this->pricing()['day']);
        Log::info($this->pricing()['department']);
        Log::info($days);
        Log::info($this->departmentCount);

        $this->price = $days * $this->pricing()['day'] + $this->departmentCount * $this->pricing()['department'];

        if (is_nan($this->price) || $this->price < 0) {
            return "";
        }

        return $this->price;    
    }
    
    private function productionDaysInCalendarTimes() 
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $this->startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->endDate);
        
        $diffInDays = $endDate->diff($startDate)->days;
        $diffInWeeks = floor($endDate->diff($startDate)->days / 7);
        $diffInMonths = $endDate->diff($startDate)->m + ($endDate->diff($startDate)->y * 12);
        
        return [
            'days' => $diffInDays,
            'weeks' => $diffInWeeks,
            'months' => $diffInMonths
        ];
    }
}