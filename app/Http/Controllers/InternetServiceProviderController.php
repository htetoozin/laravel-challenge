<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller 
{
    public function getMptInvoiceAmount(Request $request, Mpt $mpt)
    {
        $mpt->setMonth($request?->month ?: 1);
        $amount = $mpt->calculateTotalAmount();

        return response()->json([
            'data' => $amount,
        ]);
    }

    public function getOoredooInvoiceAmount(Request $request, OOredoo $ooredoo)
    {
        $ooredoo->setMonth($request?->month ?: 1);
        $amount = $ooredoo->calculateTotalAmount();

        return response()->json([
            'data' => $amount,
        ]);
    }
}
