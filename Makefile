build:
	docker-compose build

up:
	docker-compose up

exec-app:
	docker-compose exec app bash

exec-web:
	docker-compose exec web ash

exec-db:
	docker-compose exec db bash -c "mysql -u root -p"

down:
	docker-compose down
