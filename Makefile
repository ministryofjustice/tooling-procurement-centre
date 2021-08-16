.PHONY: dshell

dshell:
	echo "http://127.0.0.1:8080/" > public/hot
	docker compose up -d nginx
	docker compose run --service-ports --rm --entrypoint=bash php

setup:
	php artisan key:generate
	php artisan migrate
	php artisan db:seed
	npm ci
	npm run dev

db-migrate:
	php artisan db:wipe
	php artisan migrate
	php artisan db:seed

test:
	php artisan test

# Remove ignored git files – e.g. composer dependencies and built theme assets
# But keep .idea directory (PhpStorm config), and uploaded media files
clean:
	@if [ -d ".git" ]; then git clean -xdf --exclude ".env" --exclude ".idea" --exclude "web/app/uploads"; fi

node-assets:
	npm install
	npm run hot

build-nginx:
	docker image build -f resources/ops/docker/nginx/Dockerfile -t tp-centre-nginx:latest --target nginx .

build-fpm:
	docker image build -f resources/ops/docker/fpm/Dockerfile -t tp-centre-fpm:latest --target fpm .

ks-apply:
	kubectl apply -f resources/ops/kubernetes

ks-apply-dev:
	kubectl apply -f resources/ops/kubernetes/dev

bash-nginx:
	docker compose exec --workdir /var/www/html nginx bash

bash-node:
	docker compose exec --workdir /node node bash
