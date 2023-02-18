init: docker-down docker-pull docker-build docker-up
up: docker-up
down: docker-down
restart: docker-down docker-up


##################### COMMON COMMANDS
docker-up:
	docker-compose up -d

docker-pull:
	docker-compose pull

docker-down:
	docker-compose down --remove-orphans

docker-build: memory
	docker-compose build --pull

memory:
	sudo sysctl -w vm.max_map_count=262144

###################### BACKEND COMMANDS

## Выполнять команду вручную, ибо не срабатывает вот эта запись: (date "+%d_%m_%+_%H_%M")
dump-database:
	docker-compose exec  mysqldump -uroot -proot app > ./backups/backup_$(date "+%d_%m_%Y_%H_%M").sql

drop-database:
	docker-compose exec mysql mysql -uroot -proot -e "drop database if exists app; create database app"

chown:
	docker-compose exec php-fpm chown -R www-data /var/www/storage
	docker-compose exec php-fpm chmod -R 755 /var/www/storage

# Integration tests
run-tests: pre-tests
	docker-compose exec mysql mysql -uroot -proot -e "drop database if exists app; create database app"  && \
 	docker-compose exec php-cli php artisan cache:clear && \
 	docker-compose exec php-cli php artisan permission:cache-reset && \
 	docker-compose exec php-cli php artisan migrate --seed --env=tests && \
 	docker-compose exec php-cli php artisan test --env=tests

# Running commands before run tests
pre-tests:
	docker-compose exec php-cli php artisan key:generate --env=tests

laravel-route:
	docker-compose exec php-cli php artisan route:cache

laravel-cache:
	docker-compose exec php-cli php artisan cache:clear

laravel-migrate:
	docker-compose exec php-cli php artisan migrate

laravel-migrate-seed:
	docker-compose exec php-cli php artisan migrate --seed

laravel-storage-link:
	docker-compose exec php-cli php artisan storage:link

laravel-key-generate:
	docker-compose exec php-cli php artisan key:generate

composer-dev-install:
	docker-compose exec php-cli composer install

composer-prod-install:
	docker-compose exec php-cli composer install --no-dev

dump:
	docker-compose exec php-cli composer dumpautoload

laravel-tests:
	docker-compose exec php-cli vendor/bin/phpunit

laravel-queue:
	docker-compose exec php-cli php artisan queue:work

laravel-down:
	docker-compose exec php-cli php artisan down

laravel-up:
	docker-compose exec php-cli php artisan up

psalm:
	docker-compose exec php-cli ./vendor/bin/psalm --no-cache --show-info=true

######################## FRONTEND COMMANDS
npm-install:
	docker-compose exec -T frontend-npm npm install

build-production:
	docker-compose exec -T frontend-npm npm run build prod

npm-dev:
	docker-compose exec frontend-npm npm run dev -- --host

npm-eslint:
	docker-compose exec frontend-npm npx eslint ./src
