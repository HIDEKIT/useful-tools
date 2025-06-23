<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class IpInfoController extends Controller
{
    public function index()
    {
        return view('tools.ip');
    }

    public function getInfo(Request $request): JsonResponse
    {
        try {
            // ユーザーのIPアドレスを取得
            $clientIp = $this->getClientIpAddress($request);
            
            // 基本情報
            $ipInfo = [
                'ip' => $clientIp,
                'user_agent' => $request->header('User-Agent'),
                'timestamp' => now()->format('Y-m-d H:i:s'),
                'timezone' => date_default_timezone_get(),
            ];

            // プロキシ情報も含める
            $headers = [
                'HTTP_X_FORWARDED_FOR' => $request->header('X-Forwarded-For'),
                'HTTP_X_REAL_IP' => $request->header('X-Real-IP'),
                'HTTP_CLIENT_IP' => $request->header('Client-IP'),
                'REMOTE_ADDR' => $request->ip(),
            ];

            $ipInfo['headers'] = array_filter($headers);
            
            // 外部APIから地理情報を取得（オプション）
            try {
                $geoInfo = $this->getGeoInfo($clientIp);
                $ipInfo = array_merge($ipInfo, $geoInfo);
            } catch (\Exception $e) {
                // 地理情報の取得に失敗した場合はスキップ
                $ipInfo['geo_error'] = '地理情報の取得に失敗しました';
            }

            return response()->json([
                'success' => true,
                'data' => $ipInfo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'IP情報の取得に失敗しました: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getClientIpAddress(Request $request): string
    {
        // プロキシを考慮したIP取得
        $ipHeaders = [
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP',
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        foreach ($ipHeaders as $header) {
            $ip = $request->header(str_replace('HTTP_', '', $header));
            if ($ip && $this->isValidIp($ip)) {
                // カンマ区切りの場合は最初のIPを使用
                if (strpos($ip, ',') !== false) {
                    $ip = trim(explode(',', $ip)[0]);
                }
                if ($this->isValidIp($ip)) {
                    return $ip;
                }
            }
        }

        return $request->ip() ?? 'Unknown';
    }

    private function isValidIp(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false;
    }

    private function getGeoInfo(string $ip): array
    {
        // ローカルIPの場合は地理情報をスキップ
        if (!$this->isValidIp($ip) || $ip === '127.0.0.1' || strpos($ip, '192.168.') === 0) {
            return [
                'country' => 'ローカル',
                'region' => 'ローカル環境',
                'city' => 'ローカル',
                'isp' => 'ローカルホスト'
            ];
        }

        // 無料のIP地理情報APIを使用（ipapi.co）
        try {
            $response = file_get_contents("http://ipapi.co/{$ip}/json/", false, stream_context_create([
                'http' => [
                    'timeout' => 5,
                    'method' => 'GET',
                    'header' => 'User-Agent: Laravel-Tool/1.0'
                ]
            ]));

            if ($response === false) {
                throw new \Exception('API request failed');
            }

            $data = json_decode($response, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON response');
            }

            return [
                'country' => $data['country_name'] ?? 'Unknown',
                'region' => $data['region'] ?? 'Unknown', 
                'city' => $data['city'] ?? 'Unknown',
                'postal' => $data['postal'] ?? 'Unknown',
                'latitude' => $data['latitude'] ?? null,
                'longitude' => $data['longitude'] ?? null,
                'timezone' => $data['timezone'] ?? 'Unknown',
                'isp' => $data['org'] ?? 'Unknown'
            ];
        } catch (\Exception $e) {
            // フォールバック情報
            return [
                'country' => 'Unknown',
                'region' => 'Unknown',
                'city' => 'Unknown',
                'isp' => 'Unknown',
                'note' => '地理情報APIへのアクセスに失敗しました'
            ];
        }
    }
}