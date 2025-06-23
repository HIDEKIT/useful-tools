@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6">
    <!-- ヘッダーセクション -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-green-100 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">消費税計算ツール</h1>
        </div>
        <p class="text-gray-600">税込み・税抜き価格の相互変換と消費税額を計算します</p>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- 計算フォーム -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">税額計算</h2>
            
            <form id="taxForm" class="space-y-6">
                @csrf
                
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        金額
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400">¥</span>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               step="1" 
                               min="0"
                               placeholder="例: 1000"
                               class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                               required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        税率
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="tax_rate" value="10" checked class="sr-only">
                            <span class="flex items-center">
                                <span class="w-4 h-4 border-2 border-green-500 rounded-full mr-3 flex items-center justify-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full opacity-0 transition-opacity radio-indicator"></span>
                                </span>
                                <span class="font-medium">10%</span>
                            </span>
                        </label>
                        <label class="relative flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="tax_rate" value="8" class="sr-only">
                            <span class="flex items-center">
                                <span class="w-4 h-4 border-2 border-green-500 rounded-full mr-3 flex items-center justify-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full opacity-0 transition-opacity radio-indicator"></span>
                                </span>
                                <span class="font-medium">8% <span class="text-sm text-gray-500">(軽減税率)</span></span>
                            </span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        計算タイプ
                    </label>
                    <div class="space-y-3">
                        <label class="relative flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="type" value="exclude" checked class="sr-only">
                            <span class="flex items-center">
                                <span class="w-4 h-4 border-2 border-green-500 rounded-full mr-3 flex items-center justify-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full opacity-0 transition-opacity radio-indicator"></span>
                                </span>
                                <div>
                                    <span class="font-medium">税抜き価格から計算</span>
                                    <div class="text-sm text-gray-500">入力金額に消費税を加算</div>
                                </div>
                            </span>
                        </label>
                        <label class="relative flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="type" value="include" class="sr-only">
                            <span class="flex items-center">
                                <span class="w-4 h-4 border-2 border-green-500 rounded-full mr-3 flex items-center justify-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full opacity-0 transition-opacity radio-indicator"></span>
                                </span>
                                <div>
                                    <span class="font-medium">税込み価格から計算</span>
                                    <div class="text-sm text-gray-500">入力金額から消費税を算出</div>
                                </div>
                            </span>
                        </label>
                    </div>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 px-6 rounded-lg hover:from-green-700 hover:to-green-800 transition duration-200 font-medium shadow-sm">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    税額を計算する
                </button>
            </form>
            
            <!-- 計算結果 -->
            <div id="result" class="mt-6 hidden">
                <div class="bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">計算結果</h3>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                            <span class="text-gray-600">税抜き価格:</span>
                            <span class="text-xl font-bold text-gray-900">¥<span id="priceWithoutTax"></span></span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                            <span class="text-gray-600">消費税額:</span>
                            <span class="text-xl font-bold text-green-600">¥<span id="taxAmount"></span></span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gradient-to-r from-blue-100 to-green-100 rounded-lg border border-blue-200">
                            <span class="text-gray-700 font-medium">税込み価格:</span>
                            <span class="text-2xl font-bold text-blue-700">¥<span id="totalPrice"></span></span>
                        </div>
                    </div>
                </div>
            </div>
            
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
        
        <!-- 消費税情報 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">消費税について</h2>
            
            <div class="space-y-6">
                <div class="p-4 bg-green-50 rounded-lg">
                    <h3 class="font-medium text-green-900 mb-2">💰 標準税率 (10%)</h3>
                    <p class="text-sm text-green-800">一般的な商品・サービスに適用される税率です。</p>
                </div>
                
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-medium text-blue-900 mb-2">🍽️ 軽減税率 (8%)</h3>
                    <p class="text-sm text-blue-800 mb-2">以下の商品に適用される税率です：</p>
                    <ul class="text-sm text-blue-800 list-disc list-inside space-y-1">
                        <li>酒類・外食を除く飲食料品</li>
                        <li>週2回以上発行される新聞</li>
                    </ul>
                </div>
                
                <div class="p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-medium text-gray-900 mb-2">📊 計算方法</h3>
                    <div class="text-sm text-gray-700 space-y-2">
                        <div>
                            <strong>税抜き→税込み:</strong><br>
                            税込み価格 = 税抜き価格 × (1 + 税率)
                        </div>
                        <div>
                            <strong>税込み→税抜き:</strong><br>
                            税抜き価格 = 税込み価格 ÷ (1 + 税率)
                        </div>
                    </div>
                </div>
                
                <div class="p-4 bg-yellow-50 rounded-lg">
                    <h3 class="font-medium text-yellow-900 mb-2">⚠️ 注意事項</h3>
                    <p class="text-sm text-yellow-800">端数処理により、実際の計算結果と多少の差異が生じる場合があります。</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ラジオボタンのカスタムスタイル */
input[type="radio"]:checked + span .radio-indicator {
    opacity: 1;
}
input[type="radio"]:checked + span {
    color: #059669;
}
</style>

<script>
document.getElementById('taxForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const result = document.getElementById('result');
    const error = document.getElementById('error');
    const submitButton = e.target.querySelector('button[type="submit"]');
    
    result.classList.add('hidden');
    error.classList.add('hidden');
    
    // ローディング状態
    submitButton.disabled = true;
    submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>計算中...';
    
    try {
        const response = await fetch('/tools/tax/calculate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: JSON.stringify({
                price: formData.get('price'),
                tax_rate: formData.get('tax_rate'),
                type: formData.get('type')
            })
        });
        
        if (response.ok) {
            const data = await response.json();
            document.getElementById('priceWithoutTax').textContent = data.price_without_tax.toLocaleString();
            document.getElementById('taxAmount').textContent = data.tax_amount.toLocaleString();
            document.getElementById('totalPrice').textContent = data.total_price.toLocaleString();
            result.classList.remove('hidden');
        } else {
            document.getElementById('errorMessage').textContent = '入力値を確認してください。';
            error.classList.remove('hidden');
        }
    } catch (err) {
        document.getElementById('errorMessage').textContent = 'エラーが発生しました。';
        error.classList.remove('hidden');
    } finally {
        // ローディング状態を解除
        submitButton.disabled = false;
        submitButton.innerHTML = '<svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>税額を計算する';
    }
});

// ラジオボタンの見た目更新
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // 同じnameグループのラジオボタンの見た目をリセット
        document.querySelectorAll(`input[name="${this.name}"]`).forEach(r => {
            r.parentElement.classList.remove('border-green-500', 'bg-green-50');
            r.parentElement.classList.add('border-gray-300');
        });
        
        // 選択されたラジオボタンの見た目を更新
        this.parentElement.classList.remove('border-gray-300');
        this.parentElement.classList.add('border-green-500', 'bg-green-50');
    });
});

// 初期状態でチェックされているラジオボタンの見た目を設定
document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
    radio.parentElement.classList.remove('border-gray-300');
    radio.parentElement.classList.add('border-green-500', 'bg-green-50');
});
</script>
@endsection