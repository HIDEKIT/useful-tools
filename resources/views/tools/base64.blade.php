@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6">
    <!-- ヘッダーセクション -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-purple-100 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Base64変換ツール</h1>
        </div>
        <p class="text-gray-600">文字列とBase64形式の相互変換を行います</p>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- エンコードフォーム -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-2 mb-6">
                <div class="p-1 bg-blue-100 rounded">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">エンコード</h2>
            </div>
            
            <form id="encodeForm" class="space-y-4">
                @csrf
                
                <div>
                    <label for="encodeInput" class="block text-sm font-medium text-gray-700 mb-2">
                        入力文字列
                    </label>
                    <textarea id="encodeInput" 
                              name="input" 
                              rows="6"
                              placeholder="エンコードしたい文字列を入力してください&#10;例: Hello World!"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                              required></textarea>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-6 rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-200 font-medium shadow-sm">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    エンコード実行
                </button>
            </form>
            
            <div id="encodeResult" class="mt-6 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    結果 (Base64)
                </label>
                <div class="relative">
                    <textarea id="encodeOutput" 
                              rows="6"
                              readonly
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 resize-none"></textarea>
                    <button type="button" 
                            onclick="copyToClipboard('encodeOutput')"
                            class="absolute top-2 right-2 px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        コピー
                    </button>
                </div>
            </div>
        </div>
        
        <!-- デコードフォーム -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-2 mb-6">
                <div class="p-1 bg-green-100 rounded">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">デコード</h2>
            </div>
            
            <form id="decodeForm" class="space-y-4">
                @csrf
                
                <div>
                    <label for="decodeInput" class="block text-sm font-medium text-gray-700 mb-2">
                        Base64文字列
                    </label>
                    <textarea id="decodeInput" 
                              name="input" 
                              rows="6"
                              placeholder="デコードしたいBase64文字列を入力してください&#10;例: SGVsbG8gV29ybGQh"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none"
                              required></textarea>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 px-6 rounded-lg hover:from-green-700 hover:to-green-800 transition duration-200 font-medium shadow-sm">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                    </svg>
                    デコード実行
                </button>
            </form>
            
            <div id="decodeResult" class="mt-6 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    結果 (デコード済み)
                </label>
                <div class="relative">
                    <textarea id="decodeOutput" 
                              rows="6"
                              readonly
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 resize-none"></textarea>
                    <button type="button" 
                            onclick="copyToClipboard('decodeOutput')"
                            class="absolute top-2 right-2 px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        コピー
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- エラー表示 -->
    <div id="error" class="mt-6 hidden">
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-red-600" id="errorMessage"></p>
            </div>
        </div>
    </div>
    
    <!-- Base64について -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Base64について</h2>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-medium text-blue-900 mb-2">🔒 Base64とは</h3>
                    <p class="text-sm text-blue-800">バイナリデータをASCII文字列で表現するエンコード方式です。メールの添付ファイルやWeb上でのデータ転送に使用されます。</p>
                </div>
                
                <div class="p-4 bg-green-50 rounded-lg">
                    <h3 class="font-medium text-green-900 mb-2">📝 文字セット</h3>
                    <p class="text-sm text-green-800 mb-2">A-Z, a-z, 0-9, +, / の64文字を使用</p>
                    <p class="text-sm text-green-800">パディング文字として = を使用</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="p-4 bg-purple-50 rounded-lg">
                    <h3 class="font-medium text-purple-900 mb-2">🔄 変換例</h3>
                    <div class="text-sm text-purple-800 space-y-1">
                        <div><strong>元の文字列:</strong> Hello World!</div>
                        <div><strong>Base64:</strong> SGVsbG8gV29ybGQh</div>
                    </div>
                </div>
                
                <div class="p-4 bg-yellow-50 rounded-lg">
                    <h3 class="font-medium text-yellow-900 mb-2">⚠️ 注意事項</h3>
                    <ul class="text-sm text-yellow-800 space-y-1">
                        <li>• 暗号化ではありません</li>
                        <li>• データサイズが約33%増加します</li>
                        <li>• 改行文字は無視されます</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    element.select();
    element.setSelectionRange(0, 99999);
    
    navigator.clipboard.writeText(element.value).then(() => {
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        
        button.innerHTML = '<svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>コピー済み';
        button.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'bg-green-600', 'hover:bg-green-700');
        button.classList.add('bg-gray-600');
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.classList.remove('bg-gray-600');
            if (elementId === 'encodeOutput') {
                button.classList.add('bg-blue-600', 'hover:bg-blue-700');
            } else {
                button.classList.add('bg-green-600', 'hover:bg-green-700');
            }
        }, 2000);
    });
}

document.getElementById('encodeForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const result = document.getElementById('encodeResult');
    const error = document.getElementById('error');
    const submitButton = e.target.querySelector('button[type="submit"]');
    
    result.classList.add('hidden');
    error.classList.add('hidden');
    
    // ローディング状態
    submitButton.disabled = true;
    submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>変換中...';
    
    try {
        const response = await fetch('/tools/base64/encode', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: JSON.stringify({
                input: formData.get('input')
            })
        });
        
        if (response.ok) {
            const data = await response.json();
            document.getElementById('encodeOutput').value = data.result;
            result.classList.remove('hidden');
        } else {
            document.getElementById('errorMessage').textContent = 'エンコードエラーが発生しました。';
            error.classList.remove('hidden');
        }
    } catch (err) {
        document.getElementById('errorMessage').textContent = 'エラーが発生しました。';
        error.classList.remove('hidden');
    } finally {
        // ローディング状態を解除
        submitButton.disabled = false;
        submitButton.innerHTML = '<svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>エンコード実行';
    }
});

document.getElementById('decodeForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const result = document.getElementById('decodeResult');
    const error = document.getElementById('error');
    const submitButton = e.target.querySelector('button[type="submit"]');
    
    result.classList.add('hidden');
    error.classList.add('hidden');
    
    // ローディング状態
    submitButton.disabled = true;
    submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>変換中...';
    
    try {
        const response = await fetch('/tools/base64/decode', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: JSON.stringify({
                input: formData.get('input')
            })
        });
        
        const data = await response.json();
        
        if (response.ok) {
            document.getElementById('decodeOutput').value = data.result;
            result.classList.remove('hidden');
        } else {
            document.getElementById('errorMessage').textContent = data.error || 'デコードエラーが発生しました。';
            error.classList.remove('hidden');
        }
    } catch (err) {
        document.getElementById('errorMessage').textContent = 'エラーが発生しました。';
        error.classList.remove('hidden');
    } finally {
        // ローディング状態を解除
        submitButton.disabled = false;
        submitButton.innerHTML = '<svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>デコード実行';
    }
});
</script>
@endsection