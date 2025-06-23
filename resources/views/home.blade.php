@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6">
    <!-- ヒーローセクション -->
    <div class="text-center py-12 mb-12">
        <div class="mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            便利ツール集
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            日常で使える便利なツールを集めました。<br>
            シンプルで使いやすいインターフェースで、快適にご利用いただけます。
        </p>
        
        <!-- 統計情報 -->
        <div class="grid grid-cols-3 gap-4 max-w-md mx-auto mb-8">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">8</div>
                <div class="text-sm text-gray-500">ツール</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">無料</div>
                <div class="text-sm text-gray-500">利用料金</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">即座</div>
                <div class="text-sm text-gray-500">結果表示</div>
            </div>
        </div>
    </div>
    
    <!-- ツールカード -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        <!-- BMI計算ツール -->
        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-4 right-4">
                <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
            </div>
            
            <div class="mb-6">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-200 transition-colors">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">BMI計算</h3>
                <p class="text-gray-600 text-sm leading-relaxed">身長と体重からBMI値を計算し、肥満度を判定します。健康管理にお役立てください。</p>
            </div>
            
            <div class="space-y-2 mb-6">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    WHO基準による判定
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    カラフルな結果表示
                </div>
            </div>
            
            <a href="/tools/bmi" class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <span>BMI計算を開始</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        
        <!-- 消費税計算ツール -->
        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-4 right-4">
                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
            </div>
            
            <div class="mb-6">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-200 transition-colors">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">消費税計算</h3>
                <p class="text-gray-600 text-sm leading-relaxed">税込み・税抜き価格の相互変換と消費税額を計算します。お買い物や事業にご活用ください。</p>
            </div>
            
            <div class="space-y-2 mb-6">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    10%・8%両対応
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    軽減税率対応
                </div>
            </div>
            
            <a href="/tools/tax" class="inline-flex items-center justify-center w-full px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                <span>税額計算を開始</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        
        <!-- Base64変換ツール -->
        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-4 right-4">
                <div class="w-2 h-2 bg-purple-400 rounded-full"></div>
            </div>
            
            <div class="mb-6">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-200 transition-colors">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Base64変換</h3>
                <p class="text-gray-600 text-sm leading-relaxed">文字列とBase64形式の相互変換を行います。エンコード・デコードが簡単にできます。</p>
            </div>
            
            <div class="space-y-2 mb-6">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    双方向変換
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    ワンクリックコピー
                </div>
            </div>
            
            <a href="/tools/base64" class="inline-flex items-center justify-center w-full px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors">
                <span>変換を開始</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        
        <!-- JSON整形ツール -->
        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-4 right-4">
                <div class="w-2 h-2 bg-indigo-400 rounded-full"></div>
            </div>
            
            <div class="mb-6">
                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-200 transition-colors">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">JSON整形</h3>
                <p class="text-gray-600 text-sm leading-relaxed">JSONデータを読みやすく整形・最小化します。API開発やデバッグに便利です。</p>
            </div>
            
            <div class="space-y-2 mb-6">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    整形・最小化対応
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    エラー検知機能
                </div>
            </div>
            
            <a href="/tools/json" class="inline-flex items-center justify-center w-full px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                <span>JSON整形を開始</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        
        <!-- SQL整形ツール -->
        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-4 right-4">
                <div class="w-2 h-2 bg-emerald-400 rounded-full"></div>
            </div>
            
            <div class="mb-6">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-200 transition-colors">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">SQL整形</h3>
                <p class="text-gray-600 text-sm leading-relaxed">SQLクエリを読みやすく整形・最小化します。データベース開発に最適です。</p>
            </div>
            
            <div class="space-y-2 mb-6">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    キーワード自動大文字化
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    適切なインデント
                </div>
            </div>
            
            <a href="/tools/sql" class="inline-flex items-center justify-center w-full px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors">
                <span>SQL整形を開始</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        
        <!-- IP情報取得ツール -->
        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-4 right-4">
                <div class="w-2 h-2 bg-cyan-400 rounded-full"></div>
            </div>
            
            <div class="mb-6">
                <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-200 transition-colors">
                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">IP情報</h3>
                <p class="text-gray-600 text-sm leading-relaxed">現在のIPアドレスと地理情報を表示します。ネットワーク診断に便利です。</p>
            </div>
            
            <div class="space-y-2 mb-6">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    地理情報表示
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    ISP情報取得
                </div>
            </div>
            
            <a href="/tools/ip" class="inline-flex items-center justify-center w-full px-4 py-2 bg-cyan-600 text-white text-sm font-medium rounded-lg hover:bg-cyan-700 transition-colors">
                <span>IP情報を確認</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        
        <!-- パスワード生成ツール -->
        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-4 right-4">
                <div class="w-2 h-2 bg-red-400 rounded-full"></div>
            </div>
            
            <div class="mb-6">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-200 transition-colors">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">パスワード生成</h3>
                <p class="text-gray-600 text-sm leading-relaxed">強力で安全なパスワードを生成します。セキュリティ強化に最適です。</p>
            </div>
            
            <div class="space-y-2 mb-6">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    カスタマイズ可能
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    強度評価機能
                </div>
            </div>
            
            <a href="/tools/password" class="inline-flex items-center justify-center w-full px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                <span>パスワード生成</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        
        <!-- QRコード生成ツール -->
        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-4 right-4">
                <div class="w-2 h-2 bg-slate-400 rounded-full"></div>
            </div>
            
            <div class="mb-6">
                <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-slate-200 transition-colors">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">QRコード生成</h3>
                <p class="text-gray-600 text-sm leading-relaxed">テキストやURLをQRコードに変換します。共有やアクセスが簡単になります。</p>
            </div>
            
            <div class="space-y-2 mb-6">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    サイズ調整可能
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    エラー訂正対応
                </div>
            </div>
            
            <a href="/tools/qrcode" class="inline-flex items-center justify-center w-full px-4 py-2 bg-slate-600 text-white text-sm font-medium rounded-lg hover:bg-slate-700 transition-colors">
                <span>QRコード生成</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
    
    <!-- 機能・特徴セクション -->
    <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-8 mb-16">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">なぜこのツール集を選ぶのか</h2>
            <p class="text-gray-600">シンプルで高性能、そして完全無料の便利ツール集です</p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">高速処理</h3>
                <p class="text-sm text-gray-600">即座に結果を表示します</p>
            </div>
            
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">安全・安心</h3>
                <p class="text-sm text-gray-600">データは保存されません</p>
            </div>
            
            <div class="text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">レスポンシブ</h3>
                <p class="text-sm text-gray-600">あらゆるデバイスに対応</p>
            </div>
            
            <div class="text-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">使いやすさ</h3>
                <p class="text-sm text-gray-600">直感的なインターフェース</p>
            </div>
        </div>
    </div>
    
    <!-- 管理画面へのリンク -->
    <div class="text-center bg-white rounded-xl border border-gray-200 p-6">
        <div class="mb-4">
            <svg class="w-8 h-8 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">管理者の方へ</h3>
        <p class="text-gray-600 mb-4">ブログの投稿・編集は管理画面から行えます</p>
        <a href="/admin" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-900 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>
            管理画面にログイン
        </a>
    </div>
</div>
@endsection