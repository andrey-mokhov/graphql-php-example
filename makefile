.DEFAULT_GOAL := help
MAKEFLAGS += --no-print-directory

.EXPORT_ALL_VARIABLES:
UID := $(shell id -u)
PHP_IMAGE_VERSION := 8.1-cli-alpine3.18
RR_VERSION := 2023.2.2
ROOT_DIR := $(shell pwd)

install:
	@docker-compose -f develop/docker-compose.yml build
	@make composer_install
	@make up

up:
	@docker-compose -p roadrunner-graphql -f develop/docker-compose.yml up -d

down:
	@docker-compose -p roadrunner-graphql -f develop/docker-compose.yml down

r:
	@make restart

restart:
	@make down
	@make up

composer_install:
	@docker run -ti --rm -v ${ROOT_DIR}:/data roadrunner-graphql:local bash -c "cd /data && composer install"

build:
	@docker-compose -f develop/docker-compose.yml build

rr:
	@docker exec -ti roadrunner-graphql-dev bash
