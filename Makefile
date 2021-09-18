build-app:
	docker-compose up -d --build
ps:
	docker-compose ps
bash-php:
	docker-compose exec php bash
bash-nginx:
	docker-compose exec nginx sh