<?php

namespace App\Services\InternetServiceProvider;
use App\Services\InternetServiceProvider\OperatorInterface;

class Mpt implements OperatorInterface
{
     public function __construct(
        public int $monthlyFees = 200
    ) {}

    public function setMonth(int $month = 1)
    {
        $this->month = $month;
    }

    public function calculateTotalAmount()
    {
        return $this->month * $this->monthlyFees;
    }
}
