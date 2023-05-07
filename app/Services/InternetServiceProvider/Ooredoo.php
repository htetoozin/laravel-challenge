<?php

namespace App\Services\InternetServiceProvider;

class Ooredoo implements OperatorInterface
{
    public function __construct(
        public int $month = 1,
        public int $monthlyFees = 150
    ) {}

    public function setMonth(int $month)
    {
        $this->month = $month;
    }

    public function calculateTotalAmount()
    {
        return $this->month * $this->monthlyFees;
    }
}
