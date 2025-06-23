@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6">
    <!-- ヘッダーセクション -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-red-100 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">パスワード生成ツール</h1>
        </div>
        <p class="text-gray-600">安全で強力なパスワードを生成します</p>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- 設定パネル -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">パスワード設定</h2>
            
            <form id="passwordForm" class="space-y-6">
                @csrf
                
                <!-- 文字数設定 -->
                <div>
                    <label for="length" class="block text-sm font-medium text-gray-700 mb-2">
                        文字数: <span id="lengthValue" class="text-blue-600 font-bold">12</span>
                    </label>
                    <input type="range" 
                           id="length" 
                           name="length" 
                           min="4" 
                           max="128" 
                           value="12"
                           class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider">
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>4</span>
                        <span>128</span>
                    </div>
                </div>
                
                <!-- 文字種選択 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">含める文字種</label>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="include_lowercase" checked class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 text-sm text-gray-700">小文字 (a-z)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="include_uppercase" checked class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 text-sm text-gray-700">大文字 (A-Z)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="include_numbers" checked class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 text-sm text-gray-700">数字 (0-9)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="include_symbols" class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 text-sm text-gray-700">記号 (!@#$%^&*)</span>
                        </label>
                    </div>
                </div>
                
                <!-- オプション設定 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">オプション</label>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="exclude_ambiguous" class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 text-sm text-gray-700">紛らわしい文字を除外 (0, O, I, l, 1, |)</span>
                        </label>
                    </div>
                </div>
                
                <!-- 生成数 -->
                <div>
                    <label for="count" class="block text-sm font-medium text-gray-700 mb-2">
                        生成数
                    </label>
                    <select id="count" name="count" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="1">1個</option>
                        <option value="5">5個</option>
                        <option value="10">10個</option>
                        <option value="20">20個</option>
                    </select>
                </div>
                
                <!-- 生成ボタン -->
                <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-3 px-6 rounded-lg hover:from-red-700 hover:to-red-800 transition duration-200 font-medium shadow-sm">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    パスワードを生成
                </button>
            </form>
        </div>
        
        <!-- 結果表示 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">生成結果</h2>
                <button id="copyAllBtn" class="hidden px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    全てコピー
                </button>
            </div>
            
            <!-- エラー表示 -->
            <div id="error" class="hidden mb-4">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-red-600" id="errorMessage"></p>
                    </div>
                </div>
            </div>
            
            <!-- パスワード一覧 -->
            <div id="passwordList" class="space-y-4">
                <!-- 生成されたパスワードがここに表示されます -->
            </div>
            
            <!-- プレースホルダー -->
            <div id="placeholder" class="flex items-center justify-center h-64 text-gray-400">
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <p class="text-lg font-medium">パスワードを生成</p>
                    <p class="text-sm">設定を選択して「パスワードを生成」ボタンをクリック</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- パスワードセキュリティ情報 -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">パスワードセキュリティについて</h2>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="p-4 bg-red-50 rounded-lg">
                    <h3 class="font-medium text-red-900 mb-2">🔒 強いパスワードの条件</h3>
                    <ul class="text-sm text-red-800 space-y-1">
                        <li>• 12文字以上の長さ</li>
                        <li>• 大文字・小文字・数字・記号を含む</li>
                        <li>• 辞書に載っている単語を避ける</li>
                        <li>• 個人情報を含まない</li>
                    </ul>
                </div>
                
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-medium text-blue-900 mb-2">📱 パスワード管理</h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• パスワードマネージャーを使用</li>
                        <li>• 各サービスで異なるパスワードを使用</li>
                        <li>• 定期的な変更（重要なアカウント）</li>
                        <li>• 二要素認証の併用</li>
                    </ul>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="p-4 bg-green-50 rounded-lg">
                    <h3 class="font-medium text-green-900 mb-2">✅ セキュリティレベル</h3>
                    <div class="space-y-2 text-sm text-green-800">
                        <div class="flex justify-between">
                            <span>非常に弱い</span>
                            <span class="text-red-600">0-20点</span>
                        </div>
                        <div class="flex justify-between">
                            <span>弱い</span>
                            <span class="text-orange-600">21-40点</span>
                        </div>
                        <div class="flex justify-between">
                            <span>普通</span>
                            <span class="text-yellow-600">41-60点</span>
                        </div>
                        <div class="flex justify-between">
                            <span>強い</span>
                            <span class="text-blue-600">61-80点</span>
                        </div>
                        <div class="flex justify-between">
                            <span>非常に強い</span>
                            <span class="text-green-600">81-100点</span>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 bg-yellow-50 rounded-lg">
                    <h3 class="font-medium text-yellow-900 mb-2">⚠️ 注意事項</h3>
                    <ul class="text-sm text-yellow-800 space-y-1">
                        <li>• 生成されたパスワードは安全に保管</li>
                        <li>• 公共のコンピューターでの使用は避ける</li>
                        <li>• パスワードは他人と共有しない</li>
                        <li>• このツールはクライアント側で動作</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.slider::-webkit-slider-thumb {
    appearance: none;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #3B82F6;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #3B82F6;
    cursor: pointer;
    border: none;
}
</style>

<script>
function updateLengthDisplay() {
    const lengthSlider = document.getElementById('length');
    const lengthValue = document.getElementById('lengthValue');
    lengthValue.textContent = lengthSlider.value;
}

function getStrengthColor(color) {
    const colors = {
        'red': 'bg-red-100 text-red-800 border-red-200',
        'orange': 'bg-orange-100 text-orange-800 border-orange-200',
        'yellow': 'bg-yellow-100 text-yellow-800 border-yellow-200',
        'blue': 'bg-blue-100 text-blue-800 border-blue-200',
        'green': 'bg-green-100 text-green-800 border-green-200'
    };
    return colors[color] || colors['red'];
}

function createPasswordItem(passwordData, index) {
    const strengthClass = getStrengthColor(passwordData.strength.color);
    
    return `
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-sm transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium text-gray-600">パスワード #${index + 1}</span>
                <span class="px-2 py-1 text-xs font-medium rounded-full border ${strengthClass}">
                    ${passwordData.strength.level} (${passwordData.strength.score}点)
                </span>
            </div>
            
            <div class="relative mb-3">
                <input type="text" 
                       value="${passwordData.password}" 
                       readonly 
                       class="w-full px-3 py-2 font-mono text-sm border border-gray-300 rounded bg-gray-50 pr-20">
                <button onclick="copyPassword('${passwordData.password}', this)" 
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                    コピー
                </button>
            </div>
            
            <div class="flex items-center justify-between text-xs text-gray-500">
                <span>エントロピー: ${passwordData.entropy} bits</span>
                <span>長さ: ${passwordData.password.length}文字</span>
            </div>
            
            ${passwordData.strength.feedback.length > 0 ? `
                <div class="mt-2 text-xs text-yellow-600">
                    ${passwordData.strength.feedback.map(f => `• ${f}`).join('<br>')}
                </div>
            ` : ''}
        </div>
    `;
}

async function copyPassword(password, button) {
    try {
        await navigator.clipboard.writeText(password);
        const originalText = button.textContent;
        
        button.textContent = '済み';
        button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        button.classList.add('bg-gray-600');
        
        setTimeout(() => {
            button.textContent = originalText;
            button.classList.remove('bg-gray-600');
            button.classList.add('bg-blue-600', 'hover:bg-blue-700');
        }, 1500);
    } catch (err) {
        showError('コピーに失敗しました');
    }
}

function showError(message) {
    document.getElementById('errorMessage').textContent = message;
    document.getElementById('error').classList.remove('hidden');
}

function hideError() {
    document.getElementById('error').classList.add('hidden');
}

function showResults(passwords) {
    const passwordList = document.getElementById('passwordList');
    const placeholder = document.getElementById('placeholder');
    const copyAllBtn = document.getElementById('copyAllBtn');
    
    passwordList.innerHTML = passwords.map((pwd, idx) => createPasswordItem(pwd, idx)).join('');
    
    placeholder.classList.add('hidden');
    passwordList.classList.remove('hidden');
    copyAllBtn.classList.remove('hidden');
    
    // 全体のセキュリティスコア表示
    const avgScore = Math.round(passwords.reduce((sum, pwd) => sum + pwd.strength.score, 0) / passwords.length);
    console.log(`平均セキュリティスコア: ${avgScore}点`);
}

async function generatePasswords() {
    const form = document.getElementById('passwordForm');
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    
    hideError();
    
    // ローディング状態
    const originalHTML = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>生成中...';
    
    try {
        const data = {
            length: parseInt(formData.get('length')),
            include_uppercase: formData.has('include_uppercase'),
            include_lowercase: formData.has('include_lowercase'),
            include_numbers: formData.has('include_numbers'),
            include_symbols: formData.has('include_symbols'),
            exclude_ambiguous: formData.has('exclude_ambiguous'),
            count: parseInt(formData.get('count'))
        };
        
        const response = await fetch('/tools/password/generate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showResults(result.passwords);
        } else {
            showError(result.error || 'パスワード生成に失敗しました');
        }
    } catch (err) {
        showError('ネットワークエラーが発生しました');
    } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = originalHTML;
    }
}

// イベントリスナー
document.getElementById('length').addEventListener('input', updateLengthDisplay);

document.getElementById('passwordForm').addEventListener('submit', (e) => {
    e.preventDefault();
    generatePasswords();
});

document.getElementById('copyAllBtn').addEventListener('click', async () => {
    const passwords = Array.from(document.querySelectorAll('#passwordList input[type="text"]'))
        .map(input => input.value)
        .join('\n');
    
    try {
        await navigator.clipboard.writeText(passwords);
        const button = document.getElementById('copyAllBtn');
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
        showError('コピーに失敗しました');
    }
});

// 初期化
updateLengthDisplay();
</script>
@endsection