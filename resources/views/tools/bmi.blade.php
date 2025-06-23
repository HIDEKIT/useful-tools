@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6">
    <!-- ヘッダーセクション -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-blue-100 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">BMI計算ツール</h1>
        </div>
        <p class="text-gray-600">身長と体重からBMI値を計算し、肥満度を判定します</p>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- 計算フォーム -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">BMI計算</h2>
            
            <form id="bmiForm" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">
                            体重 (kg)
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="weight" 
                                   name="weight" 
                                   step="0.1" 
                                   min="1" 
                                   max="500"
                                   placeholder="例: 65.5"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   required>
                            <span class="absolute right-3 top-3 text-gray-400 text-sm">kg</span>
                        </div>
                    </div>
                    
                    <div>
                        <label for="height" class="block text-sm font-medium text-gray-700 mb-2">
                            身長 (cm)
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="height" 
                                   name="height" 
                                   step="0.1" 
                                   min="50" 
                                   max="300"
                                   placeholder="例: 170.5"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   required>
                            <span class="absolute right-3 top-3 text-gray-400 text-sm">cm</span>
                        </div>
                    </div>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-6 rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-200 font-medium shadow-sm">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    BMIを計算する
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
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">BMI値:</span>
                            <span class="text-3xl font-bold text-blue-600" id="bmiValue"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">判定:</span>
                            <span class="text-lg font-semibold px-3 py-1 rounded-full" id="bmiCategory"></span>
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
        
        <!-- BMI判定基準 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">BMI判定基準</h2>
            
            <div class="space-y-3">
                <div class="grid grid-cols-3 gap-4 text-sm font-medium text-gray-500 pb-2 border-b">
                    <span>BMI値</span>
                    <span>判定</span>
                    <span>色分け</span>
                </div>
                
                <div class="space-y-2">
                    <div class="grid grid-cols-3 gap-4 py-2 border-b border-gray-100">
                        <span class="text-gray-700">18.5未満</span>
                        <span class="text-gray-700">低体重</span>
                        <div class="w-4 h-4 bg-blue-300 rounded"></div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 py-2 border-b border-gray-100">
                        <span class="text-gray-700">18.5〜25未満</span>
                        <span class="text-gray-700">普通体重</span>
                        <div class="w-4 h-4 bg-green-400 rounded"></div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 py-2 border-b border-gray-100">
                        <span class="text-gray-700">25〜30未満</span>
                        <span class="text-gray-700">肥満(1度)</span>
                        <div class="w-4 h-4 bg-yellow-400 rounded"></div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 py-2 border-b border-gray-100">
                        <span class="text-gray-700">30〜35未満</span>
                        <span class="text-gray-700">肥満(2度)</span>
                        <div class="w-4 h-4 bg-orange-400 rounded"></div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 py-2 border-b border-gray-100">
                        <span class="text-gray-700">35〜40未満</span>
                        <span class="text-gray-700">肥満(3度)</span>
                        <div class="w-4 h-4 bg-red-400 rounded"></div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 py-2">
                        <span class="text-gray-700">40以上</span>
                        <span class="text-gray-700">肥満(4度)</span>
                        <div class="w-4 h-4 bg-red-600 rounded"></div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="font-medium text-blue-900 mb-2">💡 BMIについて</h3>
                <p class="text-sm text-blue-800">BMI（Body Mass Index）は、身長と体重から計算される肥満度を表す指標です。標準値は22とされ、18.5〜25が普通体重の範囲です。</p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('bmiForm').addEventListener('submit', async (e) => {
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
        const response = await fetch('/tools/bmi/calculate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: JSON.stringify({
                weight: formData.get('weight'),
                height: formData.get('height')
            })
        });
        
        if (response.ok) {
            const data = await response.json();
            document.getElementById('bmiValue').textContent = data.bmi;
            
            const categoryElement = document.getElementById('bmiCategory');
            categoryElement.textContent = data.category;
            
            // カテゴリーに応じた色分け
            categoryElement.className = 'text-lg font-semibold px-3 py-1 rounded-full ';
            if (data.bmi < 18.5) {
                categoryElement.className += 'bg-blue-100 text-blue-800';
            } else if (data.bmi < 25) {
                categoryElement.className += 'bg-green-100 text-green-800';
            } else if (data.bmi < 30) {
                categoryElement.className += 'bg-yellow-100 text-yellow-800';
            } else if (data.bmi < 35) {
                categoryElement.className += 'bg-orange-100 text-orange-800';
            } else {
                categoryElement.className += 'bg-red-100 text-red-800';
            }
            
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
        submitButton.innerHTML = '<svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>BMIを計算する';
    }
});
</script>
@endsection