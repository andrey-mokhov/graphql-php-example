.DEFAULT_GOAL := help
MAKEFLAGS += --no-print-directory

.EXPORT_ALL_VARIABLES:
PHP_IMAGE_VERSION := 8.1-cli-alpine3.18
RR_VERSION := 2023.3.3
ROOT_DIR := $(shell pwd)

install:
	@cp .env.sample .env
	@echo "UID=$(shell id -u)" >> .env
	@echo "PHP_IMAGE_VERSION=8.1-cli-alpine3.18" >> .env
	@echo "RR_VERSION=2023.3.3" >> .env
	@docker-compose build
	@make composer_install
	@docker run -ti --rm -v ${ROOT_DIR}:/data graphql-spiral:local sh -c "cd /data && php app.php encrypt:key --no-ansi -n -m .env"
	@make up

up:
	@docker-compose up -d

down:
	@docker-compose down

r:
	@make restart

restart:
	@make down
	@make up

composer_install:
	@docker run -ti --rm -v ${ROOT_DIR}:/data graphql-spiral:local sh -c "cd /data && composer install"

build:
	@docker-compose build

rr:
	@docker exec -ti graphql-spiral-dev sh
