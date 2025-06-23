<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JsonFormatterController extends Controller
{
    public function index()
    {
        return view('tools.json');
    }

    public function format(Request $request): JsonResponse
    {
        $request->validate([
            'input' => 'required|string'
        ]);

        $input = $request->input('input');
        
        try {
            // JSONをデコードして再エンコードで整形
            $decoded = json_decode($input, true, 512, JSON_THROW_ON_ERROR);
            $formatted = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            
            return response()->json([
                'formatted' => $formatted,
                'status' => 'success'
            ]);
        } catch (\JsonException $e) {
            return response()->json([
                'error' => 'JSONの形式が正しくありません: ' . $e->getMessage(),
                'status' => 'error'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'エラーが発生しました: ' . $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    public function minify(Request $request): JsonResponse
    {
        $request->validate([
            'input' => 'required|string'
        ]);

        $input = $request->input('input');
        
        try {
            // JSONをデコードして最小化
            $decoded = json_decode($input, true, 512, JSON_THROW_ON_ERROR);
            $minified = json_encode($decoded, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            
            return response()->json([
                'minified' => $minified,
                'status' => 'success'
            ]);
        } catch (\JsonException $e) {
            return response()->json([
                'error' => 'JSONの形式が正しくありません: ' . $e->getMessage(),
                'status' => 'error'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'エラーが発生しました: ' . $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }
}