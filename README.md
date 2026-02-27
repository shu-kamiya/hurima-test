# 環境構築

## Dockerビルド
- git clone <git@github.com:shu-kamiya/hurima-test.git>
- docker-compose up -d --build

## Laravel環境構築
- docker-compose exec php bash
- composer install
- cp .env.example .env、環境変数を変更
- php artisan key:generate
- php artisan migrate
- php artisan storage:link
- php artisan migrate --seed

## 開発環境
- アプリ：http://localhost/
- phpMyAdmin：http://localhost:8080/

## ER図

![ER図](er-diagram.png)


## 使用技術
- PHP 8.1.33
- Laravel 8.83.8
- MySQL 8.0.26
- Nginx
- Docker / Docker-compose
- HTML / CSS
- Git / GitHub
