# PHP + Composer + Apache
FROM php:8.2-apache

# システム依存ツールなどのインストール
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache設定
RUN a2enmod rewrite
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# プロジェクトファイルをコピー
COPY . /var/www/html/
WORKDIR /var/www/html

# 環境ファイル準備（composer install前に必要）
RUN cp .env.docker .env

# 権限設定
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Composer依存関係インストール（本番環境用）
# まずはスクリプトなしでインストール
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Laravel Artisanコマンド実行（.envがある状態で）
RUN php artisan key:generate --force

# 必要なComposerスクリプトを個別実行
RUN composer dump-autoload --optimize

# Node.js依存関係インストールとビルド
RUN npm ci \
    && npm run build \
    && rm -rf node_modules

# Laravel設定（本番環境用）
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan filament:upgrade

# 環境変数設定用のスクリプト
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80
CMD ["/usr/local/bin/start.sh"]