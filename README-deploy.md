# 便利ツール集

Laravel製の便利ツール集Webアプリケーションです。

## 機能

1. **BMI計算ツール** - 身長と体重からBMI値を計算
2. **消費税計算ツール** - 税込み・税抜き価格の相互変換
3. **Base64変換ツール** - 文字列とBase64の相互変換
4. **JSON整形ツール** - JSONデータの整形・最小化
5. **SQL整形ツール** - SQLクエリの整形・最小化
6. **IP情報取得ツール** - IPアドレスと地理情報の表示
7. **パスワード生成ツール** - 強力なパスワードの生成
8. **QRコード生成ツール** - テキストやURLのQRコード化

## 技術スタック

- **バックエンド**: Laravel 11.x
- **フロントエンド**: Blade Templates + Tailwind CSS
- **管理画面**: Filament 3.x
- **データベース**: MySQL
- **コンテナ**: Docker

## デプロイ方法（Render）

### 前提条件
- GitHubにリポジトリをプッシュしておく
- Renderアカウントを作成しておく

### デプロイ手順

1. **GitHubリポジトリの準備**
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin <your-github-repo-url>
   git push -u origin main
   ```

2. **Renderでのデプロイ**
   - Renderダッシュボードにログイン
   - "New +" → "Blueprint"を選択
   - GitHubリポジトリを接続
   - `render.yaml`が自動検出される
   - デプロイを開始

3. **環境変数の設定**
   Renderの環境変数で以下を設定：
   ```
   APP_NAME=便利ツール集
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=<自動生成される>
   APP_URL=<RenderのURL>
   DB_HOST=<RenderのDB Host>
   DB_DATABASE=<DB名>
   DB_USERNAME=<DB User>
   DB_PASSWORD=<DB Password>
   ```

### ローカル開発環境

1. **依存関係のインストール**
   ```bash
   composer install
   npm install
   ```

2. **環境設定**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **データベース設定**
   - `.env`ファイルのDB設定を更新
   - `php artisan migrate`

4. **アセットビルド**
   ```bash
   npm run dev
   ```

5. **サーバー起動**
   ```bash
   php artisan serve
   ```

## Docker使用方法

```bash
# イメージビルド
docker build -t useful-tools .

# コンテナ起動
docker run -p 8080:80 useful-tools
```

## 管理画面

- URL: `/admin`
- ブログ投稿の作成・編集が可能
- 初回アクセス時にユーザー登録が必要

## ライセンス

MIT License