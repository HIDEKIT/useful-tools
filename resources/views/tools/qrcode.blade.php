@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6">
    <!-- ヘッダーセクション -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-gray-100 rounded-lg">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">QRコード生成ツール</h1>
        </div>
        <p class="text-gray-600">テキストやURLをQRコードに変換します</p>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- 入力・設定パネル -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">QRコード設定</h2>
            
            <form id="qrForm" class="space-y-6">
                @csrf
                
                <!-- テキスト入力 -->
                <div>
                    <label for="qrText" class="block text-sm font-medium text-gray-700 mb-2">
                        テキスト・URL
                    </label>
                    <textarea id="qrText" 
                              name="text" 
                              rows="6"
                              placeholder="QRコードにしたいテキストやURLを入力してください&#10;例: https://example.com&#10;例: お疲れ様でした！"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors resize-none"
                              required></textarea>
                    <div class="flex justify-between mt-1">
                        <span class="text-xs text-gray-500">文字数: <span id="charCount">0</span></span>
                        <span class="text-xs text-gray-500">最大: 2000文字</span>
                    </div>
                </div>
                
                <!-- クイック入力ボタン -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">クイック入力</label>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" onclick="setQuickText('wifi')" class="px-3 py-2 text-sm bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors">
                            WiFi設定
                        </button>
                        <button type="button" onclick="setQuickText('contact')" class="px-3 py-2 text-sm bg-green-100 text-green-700 rounded hover:bg-green-200 transition-colors">
                            連絡先
                        </button>
                        <button type="button" onclick="setQuickText('url')" class="px-3 py-2 text-sm bg-purple-100 text-purple-700 rounded hover:bg-purple-200 transition-colors">
                            Website
                        </button>
                        <button type="button" onclick="setQuickText('email')" class="px-3 py-2 text-sm bg-orange-100 text-orange-700 rounded hover:bg-orange-200 transition-colors">
                            メール
                        </button>
                    </div>
                </div>
                
                <!-- サイズ設定 -->
                <div>
                    <label for="qrSize" class="block text-sm font-medium text-gray-700 mb-2">
                        サイズ: <span id="sizeValue" class="text-gray-600 font-bold">300px</span>
                    </label>
                    <input type="range" 
                           id="qrSize" 
                           name="size" 
                           min="100" 
                           max="800" 
                           value="300"
                           class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider">
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>100px</span>
                        <span>800px</span>
                    </div>
                </div>
                
                <!-- エラー訂正レベル -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">エラー訂正レベル</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="error_correction" value="L" class="h-4 w-4 text-gray-600">
                            <div class="ml-3">
                                <div class="text-sm font-medium">低 (L)</div>
                                <div class="text-xs text-gray-500">~7%復元</div>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors bg-gray-50">
                            <input type="radio" name="error_correction" value="M" checked class="h-4 w-4 text-gray-600">
                            <div class="ml-3">
                                <div class="text-sm font-medium">中 (M)</div>
                                <div class="text-xs text-gray-500">~15%復元</div>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="error_correction" value="Q" class="h-4 w-4 text-gray-600">
                            <div class="ml-3">
                                <div class="text-sm font-medium">中高 (Q)</div>
                                <div class="text-xs text-gray-500">~25%復元</div>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="error_correction" value="H" class="h-4 w-4 text-gray-600">
                            <div class="ml-3">
                                <div class="text-sm font-medium">高 (H)</div>
                                <div class="text-xs text-gray-500">~30%復元</div>
                            </div>
                        </label>
                    </div>
                </div>
                
                <!-- 生成ボタン -->
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-gray-600 to-gray-700 text-white py-3 px-6 rounded-lg hover:from-gray-700 hover:to-gray-800 transition duration-200 font-medium shadow-sm">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                        QRコード生成
                    </button>
                    <button type="button" id="analyzeBtn" class="px-4 py-3 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                        解析
                    </button>
                </div>
            </form>
        </div>
        
        <!-- 結果表示 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">生成結果</h2>
                <div class="flex space-x-2">
                    <button id="downloadBtn" class="hidden px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m-6-10v6"></path>
                        </svg>
                        保存
                    </button>
                </div>
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
            
            <!-- QRコード表示 -->
            <div id="qrResult" class="hidden">
                <div class="text-center mb-4">
                    <img id="qrImage" src="" alt="Generated QR Code" class="mx-auto border border-gray-200 rounded-lg shadow-sm">
                </div>
                
                <div class="bg-gray-50 rounded-lg p-4 text-sm">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-600">サイズ:</span>
                            <span class="text-gray-800 ml-1" id="resultSize">-</span>
                        </div>
                        <div>
                            <span class="text-gray-600">エラー訂正:</span>
                            <span class="text-gray-800 ml-1" id="resultErrorCorrection">-</span>
                        </div>
                        <div>
                            <span class="text-gray-600">データ長:</span>
                            <span class="text-gray-800 ml-1" id="resultDataLength">-</span>
                        </div>
                        <div>
                            <span class="text-gray-600">形式:</span>
                            <span class="text-gray-800 ml-1" id="resultFormat">-</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 解析結果 -->
            <div id="analysisResult" class="hidden mt-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">データ解析</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">データ種別:</span>
                        <span class="text-gray-800" id="analysisDataType">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">推奨サイズ:</span>
                        <span class="text-gray-800" id="analysisRecommendedSize">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">推奨エラー訂正:</span>
                        <span class="text-gray-800" id="analysisRecommendedEC">-</span>
                    </div>
                </div>
                
                <div id="analysisSecurityNotes" class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <h4 class="font-medium text-yellow-800 mb-2">セキュリティ注意事項</h4>
                    <div class="text-xs text-yellow-700" id="securityNotesList"></div>
                </div>
            </div>
            
            <!-- プレースホルダー -->
            <div id="placeholder" class="flex items-center justify-center h-64 text-gray-400">
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                    <p class="text-lg font-medium">QRコードを生成</p>
                    <p class="text-sm">テキストを入力して「QRコード生成」ボタンをクリック</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- QRコードについて -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">QRコードについて</h2>
        
        <div class="grid md:grid-cols-3 gap-6">
            <div class="space-y-4">
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-medium text-blue-900 mb-2">📱 使用例</h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• ウェブサイトURL</li>
                        <li>• WiFi接続情報</li>
                        <li>• 連絡先情報</li>
                        <li>• メールアドレス</li>
                        <li>• イベント情報</li>
                    </ul>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="p-4 bg-green-50 rounded-lg">
                    <h3 class="font-medium text-green-900 mb-2">⚙️ エラー訂正レベル</h3>
                    <ul class="text-sm text-green-800 space-y-1">
                        <li>• <strong>L:</strong> 約7%まで復元可能</li>
                        <li>• <strong>M:</strong> 約15%まで復元可能</li>
                        <li>• <strong>Q:</strong> 約25%まで復元可能</li>
                        <li>• <strong>H:</strong> 約30%まで復元可能</li>
                    </ul>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="p-4 bg-yellow-50 rounded-lg">
                    <h3 class="font-medium text-yellow-900 mb-2">💡 ベストプラクティス</h3>
                    <ul class="text-sm text-yellow-800 space-y-1">
                        <li>• 短いURLを使用</li>
                        <li>• 適切なサイズを選択</li>
                        <li>• 印刷品質を考慮</li>
                        <li>• 読み取りテストを実施</li>
                        <li>• セキュリティを考慮</li>
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
    background: #4B5563;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #4B5563;
    cursor: pointer;
    border: none;
}
</style>

<script>
function updateCharCount() {
    const textarea = document.getElementById('qrText');
    const charCount = document.getElementById('charCount');
    charCount.textContent = textarea.value.length;
}

function updateSizeDisplay() {
    const sizeSlider = document.getElementById('qrSize');
    const sizeValue = document.getElementById('sizeValue');
    sizeValue.textContent = sizeSlider.value + 'px';
}

function setQuickText(type) {
    const textarea = document.getElementById('qrText');
    
    const templates = {
        wifi: 'WIFI:T:WPA;S:MyWiFiNetwork;P:MyPassword;H:false;;',
        contact: `BEGIN:VCARD
VERSION:3.0
FN:田中太郎
ORG:株式会社サンプル
TEL:090-1234-5678
EMAIL:tanaka@example.com
END:VCARD`,
        url: 'https://example.com',
        email: 'mailto:someone@example.com?subject=お問い合わせ&body=こんにちは'
    };
    
    textarea.value = templates[type] || '';
    updateCharCount();
}

function showError(message) {
    document.getElementById('errorMessage').textContent = message;
    document.getElementById('error').classList.remove('hidden');
}

function hideError() {
    document.getElementById('error').classList.add('hidden');
}

function showQrResult(data) {
    const qrImage = document.getElementById('qrImage');
    const resultSize = document.getElementById('resultSize');
    const resultErrorCorrection = document.getElementById('resultErrorCorrection');
    const resultDataLength = document.getElementById('resultDataLength');
    const resultFormat = document.getElementById('resultFormat');
    
    qrImage.src = data.qr_code;
    qrImage.style.width = data.size + 'px';
    qrImage.style.height = data.size + 'px';
    
    resultSize.textContent = data.size + 'px';
    resultErrorCorrection.textContent = data.error_correction;
    resultDataLength.textContent = data.data_length + '文字';
    resultFormat.textContent = data.format.toUpperCase();
    
    document.getElementById('qrResult').classList.remove('hidden');
    document.getElementById('placeholder').classList.add('hidden');
    document.getElementById('downloadBtn').classList.remove('hidden');
}

function showAnalysisResult(analysis) {
    document.getElementById('analysisDataType').textContent = analysis.data_type.primary;
    document.getElementById('analysisRecommendedSize').textContent = analysis.recommended_size + 'px';
    document.getElementById('analysisRecommendedEC').textContent = analysis.recommended_error_correction;
    
    const securityNotesList = document.getElementById('securityNotesList');
    securityNotesList.innerHTML = analysis.security_notes.map(note => `• ${note}`).join('<br>');
    
    document.getElementById('analysisResult').classList.remove('hidden');
}

async function generateQrCode() {
    const form = document.getElementById('qrForm');
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    
    hideError();
    
    // ローディング状態
    const originalHTML = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>生成中...';
    
    try {
        const data = {
            text: formData.get('text'),
            size: parseInt(formData.get('size')),
            error_correction: formData.get('error_correction'),
            format: 'svg'
        };
        
        const response = await fetch('/tools/qrcode/generate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showQrResult(result.data);
        } else {
            showError(result.error || 'QRコード生成に失敗しました');
        }
    } catch (err) {
        showError('ネットワークエラーが発生しました');
    } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = originalHTML;
    }
}

async function analyzeData() {
    const text = document.getElementById('qrText').value.trim();
    
    if (!text) {
        showError('解析するテキストを入力してください');
        return;
    }
    
    try {
        const response = await fetch('/tools/qrcode/analyze', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ text })
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAnalysisResult(result.analysis);
        } else {
            showError(result.error || 'データ解析に失敗しました');
        }
    } catch (err) {
        showError('解析エラーが発生しました');
    }
}

function downloadQrCode() {
    const qrImage = document.getElementById('qrImage');
    const link = document.createElement('a');
    link.download = 'qrcode.svg';
    link.href = qrImage.src;
    link.click();
}

// イベントリスナー
document.getElementById('qrText').addEventListener('input', updateCharCount);
document.getElementById('qrSize').addEventListener('input', updateSizeDisplay);

document.getElementById('qrForm').addEventListener('submit', (e) => {
    e.preventDefault();
    generateQrCode();
});

document.getElementById('analyzeBtn').addEventListener('click', analyzeData);

document.getElementById('downloadBtn').addEventListener('click', downloadQrCode);

// 初期化
updateCharCount();
updateSizeDisplay();
</script>
@endsection