<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class InternetServiceProviderController extends BaseController 
{
    public function getMptInvoiceAmount(Request $request, Mpt $mpt)
    {
        $mpt->setMonth($request?->month ?: 1);
        $amount = $mpt->calculateTotalAmount();

        return $this->responseSuccess($amount);
    }

    public function getOoredooInvoiceAmount(Request $request, OOredoo $ooredoo)
    {
        $ooredoo->setMonth($request?->month ?: 1);
        $amount = $ooredoo->calculateTotalAmount();

        return $this->responseSuccess($amount);
    }
}
