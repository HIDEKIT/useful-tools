@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6">
    <!-- ヘッダーセクション -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-indigo-100 rounded-lg">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">JSON整形ツール</h1>
        </div>
        <p class="text-gray-600">JSONを読みやすく整形・最小化します</p>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- 入力フォーム -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">JSON入力</h2>
                <div class="flex space-x-2">
                    <button id="formatBtn" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        整形
                    </button>
                    <button id="minifyBtn" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                        最小化
                    </button>
                </div>
            </div>
            
            <form id="jsonForm" class="space-y-4">
                @csrf
                
                <div>
                    <label for="jsonInput" class="block text-sm font-medium text-gray-700 mb-2">
                        JSON文字列
                    </label>
                    <textarea id="jsonInput" 
                              name="input" 
                              rows="20"
                              placeholder='例: {"name": "田中太郎", "age": 30, "city": "東京"}'
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none font-mono text-sm"
                              required></textarea>
                </div>
            </form>
            
            <!-- エラー表示 -->
            <div id="error" class="mt-4 hidden">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-red-600" id="errorMessage"></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 結果表示 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">結果</h2>
                <button id="copyBtn" class="hidden px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    コピー
                </button>
            </div>
            
            <div id="result" class="hidden">
                <div class="relative">
                    <textarea id="jsonOutput" 
                              rows="20"
                              readonly
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 resize-none font-mono text-sm"></textarea>
                </div>
                
                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center space-x-4">
                            <span class="text-blue-800">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                文字数: <span id="charCount">0</span>
                            </span>
                            <span class="text-blue-800">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                行数: <span id="lineCount">0</span>
                            </span>
                        </div>
                        <span class="text-blue-600 font-medium" id="operationType"></span>
                    </div>
                </div>
            </div>
            
            <div id="placeholder" class="flex items-center justify-center h-96 text-gray-400">
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-lg font-medium">JSONを入力して整形・最小化</p>
                    <p class="text-sm">左側にJSONを入力し、整形または最小化ボタンをクリックしてください</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JSONについて -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">JSONについて</h2>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="p-4 bg-indigo-50 rounded-lg">
                    <h3 class="font-medium text-indigo-900 mb-2">📄 JSONとは</h3>
                    <p class="text-sm text-indigo-800">JavaScript Object Notationの略で、軽量なデータ交換フォーマットです。Web APIやデータストレージで広く使用されています。</p>
                </div>
                
                <div class="p-4 bg-green-50 rounded-lg">
                    <h3 class="font-medium text-green-900 mb-2">✨ 整形機能</h3>
                    <p class="text-sm text-green-800">読みにくいJSONを適切なインデントと改行で整形し、可読性を向上させます。</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-medium text-gray-900 mb-2">🗜️ 最小化機能</h3>
                    <p class="text-sm text-gray-800">不要な空白や改行を削除し、ファイルサイズを最小化します。本番環境での使用に適しています。</p>
                </div>
                
                <div class="p-4 bg-yellow-50 rounded-lg">
                    <h3 class="font-medium text-yellow-900 mb-2">⚠️ 注意事項</h3>
                    <p class="text-sm text-yellow-800">不正なJSON形式の場合、エラーメッセージが表示されます。ダブルクォートやカンマの位置にご注意ください。</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateCounts(text) {
    document.getElementById('charCount').textContent = text.length.toLocaleString();
    document.getElementById('lineCount').textContent = text.split('\n').length.toLocaleString();
}

function showResult(text, type) {
    document.getElementById('jsonOutput').value = text;
    document.getElementById('result').classList.remove('hidden');
    document.getElementById('placeholder').classList.add('hidden');
    document.getElementById('copyBtn').classList.remove('hidden');
    document.getElementById('operationType').textContent = type === 'format' ? '整形済み' : '最小化済み';
    updateCounts(text);
}

function hideResult() {
    document.getElementById('result').classList.add('hidden');
    document.getElementById('placeholder').classList.remove('hidden');
    document.getElementById('copyBtn').classList.add('hidden');
}

function showError(message) {
    document.getElementById('errorMessage').textContent = message;
    document.getElementById('error').classList.remove('hidden');
}

function hideError() {
    document.getElementById('error').classList.add('hidden');
}

async function processJson(endpoint, type) {
    const input = document.getElementById('jsonInput').value.trim();
    
    if (!input) {
        showError('JSONを入力してください。');
        return;
    }
    
    hideError();
    hideResult();
    
    // ローディング状態
    const button = type === 'format' ? document.getElementById('formatBtn') : document.getElementById('minifyBtn');
    const originalHTML = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>処理中...';
    
    try {
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ input })
        });
        
        const data = await response.json();
        
        if (response.ok) {
            const result = type === 'format' ? data.formatted : data.minified;
            showResult(result, type);
        } else {
            showError(data.error || 'エラーが発生しました。');
        }
    } catch (err) {
        showError('ネットワークエラーが発生しました。');
    } finally {
        button.disabled = false;
        button.innerHTML = originalHTML;
    }
}

document.getElementById('formatBtn').addEventListener('click', () => {
    processJson('/tools/json/format', 'format');
});

document.getElementById('minifyBtn').addEventListener('click', () => {
    processJson('/tools/json/minify', 'minify');
});

document.getElementById('copyBtn').addEventListener('click', async () => {
    const output = document.getElementById('jsonOutput');
    const button = document.getElementById('copyBtn');
    
    try {
        await navigator.clipboard.writeText(output.value);
        const originalHTML = button.innerHTML;
        
        button.innerHTML = '<svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>コピー済み';
        button.classList.remove('bg-green-600', 'hover:bg-green-700');
        button.classList.add('bg-gray-600');
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.classList.remove('bg-gray-600');
            button.classList.add('bg-green-600', 'hover:bg-green-700');
        }, 2000);
    } catch (err) {
        showError('コピーに失敗しました。');
    }
});

// JSONサンプル例を追加
document.getElementById('jsonInput').addEventListener('focus', function() {
    if (!this.value) {
        this.value = '{"name":"田中太郎","age":30,"email":"tanaka@example.com","address":{"city":"東京","country":"日本"},"hobbies":["読書","映画鑑賞","プログラミング"]}';
    }
});
</script>
@endsection