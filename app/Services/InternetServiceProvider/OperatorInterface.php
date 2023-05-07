<?php

namespace App\Services\InternetServiceProvider;

interface OperatorInterface
{
    public function setMonth(int $month);

    public function calculateTotalAmount();
}
