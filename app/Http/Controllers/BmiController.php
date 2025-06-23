<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BmiController extends Controller
{
    public function index()
    {
        return view('tools.bmi');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1|max:500',
            'height' => 'required|numeric|min:50|max:300',
        ]);

        $weight = $request->weight;
        $height = $request->height / 100;
        $bmi = round($weight / ($height * $height), 2);

        $category = '';
        if ($bmi < 18.5) {
            $category = '低体重';
        } elseif ($bmi < 25) {
            $category = '普通体重';
        } elseif ($bmi < 30) {
            $category = '肥満(1度)';
        } elseif ($bmi < 35) {
            $category = '肥満(2度)';
        } elseif ($bmi < 40) {
            $category = '肥満(3度)';
        } else {
            $category = '肥満(4度)';
        }

        return response()->json([
            'bmi' => $bmi,
            'category' => $category,
        ]);
    }
}
