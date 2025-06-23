#!/bin/bash
set -e

echo "Starting Laravel application..."

# 環境変数が設定されている場合のみキー生成
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# キャッシュクリア（開発時用）
if [ "$APP_ENV" = "local" ] || [ "$CLEAR_CACHE" = "true" ]; then
    echo "Clearing cache..."
    php artisan config:clear || true
    php artisan route:clear || true
    php artisan view:clear || true
    php artisan cache:clear || true
fi

# データベースマイグレーション（必要に応じて）
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
fi

# Filamentアップグレード（必要に応じて）
if [ "$RUN_FILAMENT_UPGRADE" = "true" ]; then
    echo "Running Filament upgrade..."
    php artisan filament:upgrade || true
fi

# 権限確認
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Apacheを起動
echo "Starting Apache..."
exec apache2-foreground