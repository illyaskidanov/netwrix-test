build:
	docker-compose exec -it php sh -c 'composer install && yarn install && yarn mix'

run:
	docker-compose up -d

migrate:
	for f in dumps/*.sql; do docker-compose exec -T db mysql -uroot netwrix < $$f; done

bash:
	docker-compose exec -it php bash