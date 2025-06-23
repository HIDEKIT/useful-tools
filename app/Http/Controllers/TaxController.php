<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        return view('tools.tax');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'tax_rate' => 'required|in:8,10',
            'type' => 'required|in:include,exclude',
        ]);

        $price = $request->price;
        $taxRate = $request->tax_rate / 100;
        $type = $request->type;

        if ($type === 'exclude') {
            $taxAmount = $price * $taxRate;
            $totalPrice = $price + $taxAmount;
            $priceWithoutTax = $price;
        } else {
            $priceWithoutTax = $price / (1 + $taxRate);
            $taxAmount = $price - $priceWithoutTax;
            $totalPrice = $price;
        }

        return response()->json([
            'price_without_tax' => round($priceWithoutTax, 0),
            'tax_amount' => round($taxAmount, 0),
            'total_price' => round($totalPrice, 0),
        ]);
    }
}
