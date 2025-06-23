<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - 便利ツール集</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- サイドバー -->
        <div class="hidden lg:flex lg:w-64 lg:flex-col">
            <div class="flex flex-col flex-grow bg-white border-r border-gray-200">
                <!-- ロゴエリア -->
                <div class="flex items-center flex-shrink-0 px-6 py-4">
                    <a href="/" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span class="text-xl font-bold text-gray-800">便利ツール集</span>
                    </a>
                </div>
                
                <!-- ナビゲーション -->
                <div class="flex-1 flex flex-col overflow-y-auto">
                    <nav class="flex-1 px-4 py-4 space-y-1">
                        <div class="mb-4">
                            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">ツール一覧</h3>
                            <div class="mt-2 space-y-1">
                                <a href="/tools/bmi" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->is('tools/bmi') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->is('tools/bmi') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    BMI計算
                                </a>

                                <a href="/tools/tax" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->is('tools/tax') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->is('tools/tax') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    消費税計算
                                </a>

                                <a href="/tools/base64" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->is('tools/base64') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->is('tools/base64') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                    </svg>
                                    Base64変換
                                </a>

                                <a href="/tools/json" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->is('tools/json') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->is('tools/json') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    JSON整形
                                </a>

                                <a href="/tools/sql" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->is('tools/sql') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->is('tools/sql') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                                    </svg>
                                    SQL整形
                                </a>

                                <a href="/tools/ip" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->is('tools/ip') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->is('tools/ip') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                    IP情報
                                </a>

                                <a href="/tools/password" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->is('tools/password') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->is('tools/password') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    パスワード生成
                                </a>

                                <a href="/tools/qrcode" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->is('tools/qrcode') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->is('tools/qrcode') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                    QRコード生成
                                </a>
                            </div>
                        </div>

                        <div>
                            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">管理</h3>
                            <div class="mt-2 space-y-1">
                                <a href="/admin" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-50 hover:text-gray-900">
                                    <svg class="mr-3 flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                    </svg>
                                    管理画面
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <!-- モバイル用サイドバー -->
        <div class="lg:hidden">
            <div id="mobile-sidebar-overlay" class="fixed inset-0 flex z-40 hidden">
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
                <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button id="close-sidebar-btn" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <div class="flex-shrink-0 flex items-center px-4">
                            <a href="/" class="flex items-center space-x-2">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="text-xl font-bold text-gray-800">便利ツール集</span>
                            </a>
                        </div>
                        
                        <nav class="mt-5 px-2 space-y-1">
                            <div class="mb-4">
                                <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">ツール一覧</h3>
                                <div class="mt-2 space-y-1">
                                    <a href="/tools/bmi" class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->is('tools/bmi') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->is('tools/bmi') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        BMI計算
                                    </a>

                                    <a href="/tools/tax" class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->is('tools/tax') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->is('tools/tax') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        消費税計算
                                    </a>

                                    <a href="/tools/base64" class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->is('tools/base64') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->is('tools/base64') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                        Base64変換
                                    </a>

                                    <a href="/tools/json" class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->is('tools/json') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->is('tools/json') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        JSON整形
                                    </a>

                                    <a href="/tools/sql" class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->is('tools/sql') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->is('tools/sql') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                                        </svg>
                                        SQL整形
                                    </a>

                                    <a href="/tools/ip" class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->is('tools/ip') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->is('tools/ip') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                        </svg>
                                        IP情報
                                    </a>

                                    <a href="/tools/password" class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->is('tools/password') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->is('tools/password') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        パスワード生成
                                    </a>

                                    <a href="/tools/qrcode" class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->is('tools/qrcode') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->is('tools/qrcode') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                        </svg>
                                        QRコード生成
                                    </a>
                                </div>
                            </div>

                            <div>
                                <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">管理</h3>
                                <div class="mt-2 space-y-1">
                                    <a href="/admin" class="group flex items-center px-2 py-2 text-base font-medium text-gray-600 rounded-md hover:bg-gray-50 hover:text-gray-900">
                                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                        </svg>
                                        管理画面
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- メインコンテンツエリア -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <!-- モバイル用ヘッダー -->
            <div class="lg:hidden">
                <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                    <button id="open-sidebar-btn" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 lg:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                    </button>
                    <div class="flex-1 px-4 flex justify-between">
                        <div class="flex-1 flex items-center">
                            <h1 class="text-lg font-medium text-gray-900">便利ツール集</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- メインコンテンツ -->
            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // モバイルサイドバーの制御
        const openSidebarBtn = document.getElementById('open-sidebar-btn');
        const closeSidebarBtn = document.getElementById('close-sidebar-btn');
        const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');

        function openMobileSidebar() {
            mobileSidebarOverlay.classList.remove('hidden');
        }

        function closeMobileSidebar() {
            mobileSidebarOverlay.classList.add('hidden');
        }

        if (openSidebarBtn) {
            openSidebarBtn.addEventListener('click', openMobileSidebar);
        }

        if (closeSidebarBtn) {
            closeSidebarBtn.addEventListener('click', closeMobileSidebar);
        }

        // オーバーレイクリックで閉じる
        if (mobileSidebarOverlay) {
            mobileSidebarOverlay.addEventListener('click', function(e) {
                if (e.target === mobileSidebarOverlay || e.target.getAttribute('aria-hidden') === 'true') {
                    closeMobileSidebar();
                }
            });
        }
    </script>
</body>
</html>