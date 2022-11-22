POST = 0.0.0.0

start:
	php artisan serve

setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm install

update db:
	rm database/database.sqlite
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

lint:
	composer phpcs -- --standard=PSR12 app routes

lint-fix:
	composer phpcbf -- --standard=PSR12 app routes tests
