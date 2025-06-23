<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SqlFormatterController extends Controller
{
    public function index()
    {
        return view('tools.sql');
    }

    public function format(Request $request): JsonResponse
    {
        $request->validate([
            'input' => 'required|string'
        ]);

        $input = trim($request->input('input'));
        
        try {
            $formatted = $this->formatSql($input);
            
            return response()->json([
                'formatted' => $formatted,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'エラーが発生しました: ' . $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    private function formatSql(string $sql): string
    {
        // SQLキーワードを大文字に変換
        $keywords = [
            'SELECT', 'FROM', 'WHERE', 'JOIN', 'INNER JOIN', 'LEFT JOIN', 'RIGHT JOIN', 'FULL JOIN',
            'GROUP BY', 'ORDER BY', 'HAVING', 'LIMIT', 'OFFSET', 'INSERT', 'INTO', 'VALUES',
            'UPDATE', 'SET', 'DELETE', 'CREATE', 'TABLE', 'ALTER', 'DROP', 'INDEX',
            'PRIMARY KEY', 'FOREIGN KEY', 'REFERENCES', 'NOT NULL', 'NULL', 'DEFAULT',
            'AUTO_INCREMENT', 'UNIQUE', 'CHECK', 'CONSTRAINT', 'DATABASE', 'SCHEMA',
            'VIEW', 'PROCEDURE', 'FUNCTION', 'TRIGGER', 'IF', 'ELSE', 'ELSIF', 'CASE',
            'WHEN', 'THEN', 'END', 'BEGIN', 'COMMIT', 'ROLLBACK', 'TRANSACTION',
            'AND', 'OR', 'NOT', 'IN', 'EXISTS', 'BETWEEN', 'LIKE', 'IS', 'AS',
            'DISTINCT', 'ALL', 'UNION', 'INTERSECT', 'EXCEPT', 'MINUS'
        ];

        // 改行とインデントを追加
        $formatted = $sql;
        
        // 不要な空白を削除
        $formatted = preg_replace('/\s+/', ' ', $formatted);
        
        // 主要なSQL句の前で改行
        $formatted = preg_replace('/\b(SELECT|FROM|WHERE|JOIN|INNER\s+JOIN|LEFT\s+JOIN|RIGHT\s+JOIN|FULL\s+JOIN|GROUP\s+BY|ORDER\s+BY|HAVING|LIMIT|UNION|INSERT\s+INTO|UPDATE|SET|DELETE\s+FROM)\b/i', "\n$1", $formatted);
        
        // カンマの後で改行（SELECT句内）
        $formatted = preg_replace('/,(?=\s*\w)/', ",\n    ", $formatted);
        
        // ANDとORの前で改行
        $formatted = preg_replace('/\b(AND|OR)\b/i', "\n  $1", $formatted);
        
        // 括弧の整形
        $formatted = preg_replace('/\(\s*/', "(\n    ", $formatted);
        $formatted = preg_replace('/\s*\)/', "\n)", $formatted);
        
        // セミコロンの後で改行
        $formatted = preg_replace('/;/', ";\n", $formatted);
        
        // キーワードを大文字に変換
        foreach ($keywords as $keyword) {
            $formatted = preg_replace('/\b' . preg_quote($keyword, '/') . '\b/i', strtoupper($keyword), $formatted);
        }
        
        // 行の先頭と末尾の空白を調整
        $lines = explode("\n", $formatted);
        $result = [];
        
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (!empty($trimmed)) {
                // インデントレベルを決定
                if (preg_match('/^(SELECT|FROM|WHERE|GROUP BY|ORDER BY|HAVING|LIMIT|UNION|INSERT INTO|UPDATE|DELETE FROM)/i', $trimmed)) {
                    $result[] = $trimmed;
                } elseif (preg_match('/^(AND|OR)/i', $trimmed)) {
                    $result[] = '  ' . $trimmed;
                } elseif (preg_match('/^,/', $trimmed)) {
                    $result[] = '    ' . ltrim($trimmed, ', ');
                } else {
                    $result[] = '    ' . $trimmed;
                }
            }
        }
        
        return implode("\n", $result);
    }

    public function minify(Request $request): JsonResponse
    {
        $request->validate([
            'input' => 'required|string'
        ]);

        $input = trim($request->input('input'));
        
        try {
            // 不要な空白、改行、タブを削除
            $minified = preg_replace('/\s+/', ' ', $input);
            $minified = trim($minified);
            
            return response()->json([
                'minified' => $minified,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'エラーが発生しました: ' . $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }
}