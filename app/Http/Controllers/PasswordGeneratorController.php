<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PasswordGeneratorController extends Controller
{
    public function index()
    {
        return view('tools.password');
    }

    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'length' => 'required|integer|min:4|max:128',
            'include_uppercase' => 'boolean',
            'include_lowercase' => 'boolean', 
            'include_numbers' => 'boolean',
            'include_symbols' => 'boolean',
            'exclude_ambiguous' => 'boolean',
            'count' => 'integer|min:1|max:50'
        ]);

        try {
            $length = $request->integer('length', 12);
            $includeUppercase = $request->boolean('include_uppercase', true);
            $includeLowercase = $request->boolean('include_lowercase', true);
            $includeNumbers = $request->boolean('include_numbers', true);
            $includeSymbols = $request->boolean('include_symbols', false);
            $excludeAmbiguous = $request->boolean('exclude_ambiguous', false);
            $count = $request->integer('count', 1);

            // 文字セットを構築
            $charset = $this->buildCharset(
                $includeUppercase,
                $includeLowercase, 
                $includeNumbers,
                $includeSymbols,
                $excludeAmbiguous
            );

            if (empty($charset)) {
                return response()->json([
                    'error' => '少なくとも1つの文字種類を選択してください。'
                ], 400);
            }

            // パスワードを生成
            $passwords = [];
            for ($i = 0; $i < $count; $i++) {
                $password = $this->generateSecurePassword($charset, $length, [
                    'uppercase' => $includeUppercase,
                    'lowercase' => $includeLowercase,
                    'numbers' => $includeNumbers,
                    'symbols' => $includeSymbols
                ]);
                
                $passwords[] = [
                    'password' => $password,
                    'strength' => $this->calculatePasswordStrength($password),
                    'entropy' => $this->calculateEntropy($password, strlen($charset))
                ];
            }

            return response()->json([
                'success' => true,
                'passwords' => $passwords,
                'settings' => [
                    'length' => $length,
                    'charset_size' => strlen($charset),
                    'include_uppercase' => $includeUppercase,
                    'include_lowercase' => $includeLowercase,
                    'include_numbers' => $includeNumbers,
                    'include_symbols' => $includeSymbols,
                    'exclude_ambiguous' => $excludeAmbiguous
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'パスワード生成に失敗しました: ' . $e->getMessage()
            ], 500);
        }
    }

    private function buildCharset(bool $uppercase, bool $lowercase, bool $numbers, bool $symbols, bool $excludeAmbiguous): string
    {
        $charset = '';

        if ($lowercase) {
            $charset .= 'abcdefghijklmnopqrstuvwxyz';
        }

        if ($uppercase) {
            $charset .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        if ($numbers) {
            $charset .= '0123456789';
        }

        if ($symbols) {
            $charset .= '!@#$%^&*()_+-=[]{}|;:,.<>?';
        }

        // 紛らわしい文字を除外
        if ($excludeAmbiguous && !empty($charset)) {
            $ambiguous = ['0', 'O', 'o', 'I', 'l', '1', '|'];
            foreach ($ambiguous as $char) {
                $charset = str_replace($char, '', $charset);
            }
        }

        return $charset;
    }

    private function generateSecurePassword(string $charset, int $length, array $requirements): string
    {
        $charsetLength = strlen($charset);
        $password = '';

        // 暗号学的に安全な乱数生成器を使用
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $charsetLength - 1);
            $password .= $charset[$randomIndex];
        }

        // 要求された文字種が含まれているかチェック
        $attempts = 0;
        while (!$this->meetsRequirements($password, $requirements) && $attempts < 100) {
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $randomIndex = random_int(0, $charsetLength - 1);
                $password .= $charset[$randomIndex];
            }
            $attempts++;
        }

        return $password;
    }

    private function meetsRequirements(string $password, array $requirements): bool
    {
        if ($requirements['uppercase'] && !preg_match('/[A-Z]/', $password)) {
            return false;
        }
        if ($requirements['lowercase'] && !preg_match('/[a-z]/', $password)) {
            return false;
        }
        if ($requirements['numbers'] && !preg_match('/[0-9]/', $password)) {
            return false;
        }
        if ($requirements['symbols'] && !preg_match('/[!@#$%^&*()_+\-=\[\]{}|;:,.<>?]/', $password)) {
            return false;
        }
        return true;
    }

    private function calculatePasswordStrength(string $password): array
    {
        $length = strlen($password);
        $score = 0;
        $feedback = [];

        // 長さによる評価
        if ($length >= 12) {
            $score += 25;
        } elseif ($length >= 8) {
            $score += 10;
            $feedback[] = '12文字以上推奨';
        } else {
            $feedback[] = '8文字以上必須';
        }

        // 文字種による評価
        if (preg_match('/[a-z]/', $password)) $score += 5;
        if (preg_match('/[A-Z]/', $password)) $score += 5;
        if (preg_match('/[0-9]/', $password)) $score += 5;
        if (preg_match('/[!@#$%^&*()_+\-=\[\]{}|;:,.<>?]/', $password)) $score += 10;

        // 複雑さによる評価
        $uniqueChars = count(array_unique(str_split($password)));
        if ($uniqueChars >= $length * 0.7) $score += 10;

        // 繰り返しパターンのチェック
        if (!preg_match('/(.)\1{2,}/', $password)) $score += 5;

        // スコアを100点満点に正規化
        $score = min(100, $score);

        // 強度レベルを決定
        if ($score >= 80) {
            $level = '非常に強い';
            $color = 'green';
        } elseif ($score >= 60) {
            $level = '強い';
            $color = 'blue';
        } elseif ($score >= 40) {
            $level = '普通';
            $color = 'yellow';
        } elseif ($score >= 20) {
            $level = '弱い';
            $color = 'orange';
        } else {
            $level = '非常に弱い';
            $color = 'red';
        }

        return [
            'score' => $score,
            'level' => $level,
            'color' => $color,
            'feedback' => $feedback
        ];
    }

    private function calculateEntropy(string $password, int $charsetSize): float
    {
        $length = strlen($password);
        return round($length * log($charsetSize, 2), 2);
    }
}