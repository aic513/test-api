install:
	composer install

test:
	composer run-script phpunit tests

run:
	php -S localhost:8000 -t public

dumpautoload:
	composer dump-autoload --optimize
