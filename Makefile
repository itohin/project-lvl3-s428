install:
	composer install
lint:
	composer run-script phpcs -- --standard=PSR12 app bootstrap routes
test:
	phpunit
logs:
	tail -f storage/logs/lumen.log