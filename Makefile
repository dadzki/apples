up: docker-up
down: docker-down
restart: docker-down docker-up
init: docker-down docker-pull docker-build docker-up composer-install migrations


docker-up:
	docker-compose up -d
docker-down:
	docker-compose down
docker-pull:
	docker-compose pull
docker-build:
	docker-compose build

composer-install:
	docker-compose run --rm php-fpm composer install

migrations:
	docker-compose run --rm php-fpm ./yii migrate
