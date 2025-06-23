<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Base64Controller extends Controller
{
    public function index()
    {
        return view('tools.base64');
    }

    public function encode(Request $request)
    {
        $request->validate([
            'input' => 'required|string',
        ]);

        $encoded = base64_encode($request->input);

        return response()->json([
            'result' => $encoded,
        ]);
    }

    public function decode(Request $request)
    {
        $request->validate([
            'input' => 'required|string',
        ]);

        try {
            $decoded = base64_decode($request->input, true);
            
            if ($decoded === false) {
                return response()->json([
                    'error' => '無効なBase64文字列です。',
                ], 400);
            }

            return response()->json([
                'result' => $decoded,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'デコードエラーが発生しました。',
            ], 400);
        }
    }
}
