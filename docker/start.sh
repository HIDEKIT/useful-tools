#!/bin/bash

# 環境変数が設定されている場合のみキー生成
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# データベースマイグレーション（必要に応じて）
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
fi

# Apacheを起動
echo "Starting Apache..."
exec apache2-foreground