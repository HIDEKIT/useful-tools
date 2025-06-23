<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BmiController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\Base64Controller;
use App\Http\Controllers\JsonFormatterController;
use App\Http\Controllers\SqlFormatterController;
use App\Http\Controllers\IpInfoController;
use App\Http\Controllers\PasswordGeneratorController;
use App\Http\Controllers\QrCodeController;

Route::get('/', function () {
    return view('home');
});

Route::prefix('tools')->group(function () {
    Route::get('/bmi', [BmiController::class, 'index']);
    Route::post('/bmi/calculate', [BmiController::class, 'calculate']);
    
    Route::get('/tax', [TaxController::class, 'index']);
    Route::post('/tax/calculate', [TaxController::class, 'calculate']);
    
    Route::get('/base64', [Base64Controller::class, 'index']);
    Route::post('/base64/encode', [Base64Controller::class, 'encode']);
    Route::post('/base64/decode', [Base64Controller::class, 'decode']);
    
    Route::get('/json', [JsonFormatterController::class, 'index']);
    Route::post('/json/format', [JsonFormatterController::class, 'format']);
    Route::post('/json/minify', [JsonFormatterController::class, 'minify']);
    
    Route::get('/sql', [SqlFormatterController::class, 'index']);
    Route::post('/sql/format', [SqlFormatterController::class, 'format']);
    Route::post('/sql/minify', [SqlFormatterController::class, 'minify']);
    
    Route::get('/ip', [IpInfoController::class, 'index']);
    Route::post('/ip/info', [IpInfoController::class, 'getInfo']);
    
    Route::get('/password', [PasswordGeneratorController::class, 'index']);
    Route::post('/password/generate', [PasswordGeneratorController::class, 'generate']);
    
    Route::get('/qrcode', [QrCodeController::class, 'index']);
    Route::post('/qrcode/generate', [QrCodeController::class, 'generate']);
    Route::post('/qrcode/analyze', [QrCodeController::class, 'analyze']);
});
