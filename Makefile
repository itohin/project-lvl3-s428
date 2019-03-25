install:
	composer install
lint:
	composer run-script phpcs -- --standard=PSR12 app bootstrap routes tests
logs:
	tail -f storage/logs/lumen.log