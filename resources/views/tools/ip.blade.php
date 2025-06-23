@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6">
    <!-- ヘッダーセクション -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-blue-100 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">IP情報取得ツール</h1>
        </div>
        <p class="text-gray-600">あなたのIPアドレスと関連情報を表示します</p>
    </div>
    
    <!-- 取得ボタン -->
    <div class="text-center mb-8">
        <button id="getIpBtn" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            IP情報を取得
        </button>
    </div>
    
    <!-- ローディング表示 -->
    <div id="loading" class="hidden text-center py-8">
        <div class="inline-flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-lg text-gray-600">情報を取得中...</span>
        </div>
    </div>
    
    <!-- エラー表示 -->
    <div id="error" class="hidden mb-6">
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-red-600" id="errorMessage"></p>
            </div>
        </div>
    </div>
    
    <!-- 結果表示 -->
    <div id="result" class="hidden">
        <div class="grid md:grid-cols-2 gap-6">
            <!-- 基本情報 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-2 mb-4">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-900">基本情報</h2>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600 font-medium">IPアドレス</span>
                        <span class="text-lg font-mono font-bold text-blue-600" id="ipAddress">-</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600 font-medium">取得日時</span>
                        <span class="text-sm text-gray-800" id="timestamp">-</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600 font-medium">タイムゾーン</span>
                        <span class="text-sm text-gray-800" id="timezone">-</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button id="copyIpBtn" class="w-full px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        IPアドレスをコピー
                    </button>
                </div>
            </div>
            
            <!-- 地理情報 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-2 mb-4">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-900">地理情報</h2>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">国</span>
                        <span class="text-gray-800" id="country">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">地域</span>
                        <span class="text-gray-800" id="region">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">都市</span>
                        <span class="text-gray-800" id="city">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">郵便番号</span>
                        <span class="text-gray-800" id="postal">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">ISP</span>
                        <span class="text-gray-800 text-sm" id="isp">-</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ブラウザ情報 -->
        <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-2 mb-4">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <h2 class="text-xl font-semibold text-gray-900">ブラウザ情報</h2>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-700 font-mono" id="userAgent">-</p>
            </div>
        </div>
        
        <!-- ネットワーク詳細 -->
        <div id="networkDetails" class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-2 mb-4">
                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h6m-3 0L9 9l3-3m-3 3h0"></path>
                </svg>
                <h2 class="text-xl font-semibold text-gray-900">ネットワーク詳細</h2>
            </div>
            
            <div id="headersList" class="space-y-2">
                <!-- ヘッダー情報がここに動的に追加されます -->
            </div>
        </div>
    </div>
    
    <!-- 注意事項 -->
    <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
        <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <div>
                <h3 class="text-lg font-semibold text-yellow-800 mb-2">注意事項</h3>
                <ul class="text-sm text-yellow-700 space-y-1">
                    <li>• 表示されるIPアドレスは、プロキシやVPNを使用している場合は実際のIPと異なる場合があります</li>
                    <li>• 地理情報は近似値であり、正確な位置を示すものではありません</li>
                    <li>• この情報は公開情報に基づいており、プライバシーに関わる詳細な情報は含まれていません</li>
                    <li>• ローカル環境（localhost）では、地理情報は取得できません</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function showLoading() {
    document.getElementById('loading').classList.remove('hidden');
    document.getElementById('result').classList.add('hidden');
    document.getElementById('error').classList.add('hidden');
}

function hideLoading() {
    document.getElementById('loading').classList.add('hidden');
}

function showError(message) {
    document.getElementById('errorMessage').textContent = message;
    document.getElementById('error').classList.remove('hidden');
    hideLoading();
}

function showResult(data) {
    // 基本情報
    document.getElementById('ipAddress').textContent = data.ip || 'Unknown';
    document.getElementById('timestamp').textContent = data.timestamp || 'Unknown';
    document.getElementById('timezone').textContent = data.timezone || 'Unknown';
    
    // 地理情報
    document.getElementById('country').textContent = data.country || 'Unknown';
    document.getElementById('region').textContent = data.region || 'Unknown';
    document.getElementById('city').textContent = data.city || 'Unknown';
    document.getElementById('postal').textContent = data.postal || 'Unknown';
    document.getElementById('isp').textContent = data.isp || 'Unknown';
    
    // ブラウザ情報
    document.getElementById('userAgent').textContent = data.user_agent || 'Unknown';
    
    // ネットワーク詳細
    const headersList = document.getElementById('headersList');
    headersList.innerHTML = '';
    
    if (data.headers && Object.keys(data.headers).length > 0) {
        Object.entries(data.headers).forEach(([key, value]) => {
            if (value) {
                const div = document.createElement('div');
                div.className = 'flex justify-between items-start p-2 bg-gray-50 rounded text-sm';
                div.innerHTML = `
                    <span class="text-gray-600 font-medium">${key}</span>
                    <span class="text-gray-800 text-right ml-4 font-mono">${value}</span>
                `;
                headersList.appendChild(div);
            }
        });
    } else {
        headersList.innerHTML = '<p class="text-gray-500 text-sm">ネットワークヘッダー情報はありません</p>';
    }
    
    document.getElementById('result').classList.remove('hidden');
    hideLoading();
}

async function getIpInfo() {
    showLoading();
    
    try {
        const response = await fetch('/tools/ip/info', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            showResult(result.data);
        } else {
            showError(result.error || 'IP情報の取得に失敗しました');
        }
    } catch (error) {
        showError('ネットワークエラーが発生しました: ' + error.message);
    }
}

// イベントリスナー
document.getElementById('getIpBtn').addEventListener('click', getIpInfo);

document.getElementById('copyIpBtn').addEventListener('click', async () => {
    const ipAddress = document.getElementById('ipAddress').textContent;
    const button = document.getElementById('copyIpBtn');
    
    try {
        await navigator.clipboard.writeText(ipAddress);
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

// ページ読み込み時に自動取得
document.addEventListener('DOMContentLoaded', () => {
    getIpInfo();
});
</script>
@endsection