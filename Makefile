setup:
	docker-compose run --rm setup

test:
	docker-compose run --rm php vendor/bin/phpunit
