#!/usr/bin/env bash
cp .env.example .env
cp src/Infrastructure/UI/Laravel/.env.example src/Infrastructure/UI/Laravel/.env
docker-compose up -d --build
docker exec -it pineapple_app composer install
docker exec -it pineapple_app mkdir src/Infrastructure/UI/Laravel/bootstrap/cache
docker exec -it pineapple_app php artisan key:generate
docker exec -it pineapple_server chown www-data src/Infrastructure/UI/Laravel/storage/ -R
docker exec -it pineapple_server chown www-data src/Infrastructure/UI/Laravel/bootstrap/ -R
./migration.sh "migrations:migrate"
docker exec -it pineapple_app php artisan jwt:secret
