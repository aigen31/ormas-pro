SHELL := /bin/bash

.PHONY: up down reset logs ps test seed wp

up:
	./bin/dev-up.sh

down:
	docker compose down

reset:
	docker compose down -v
	@echo "Containers and local database volume removed."

logs:
	docker compose logs -f --tail=100 wordpress wp-init

ps:
	docker compose ps

test:
	./bin/smoke-test.sh

seed:
	./bin/seed-demo.sh

wp:
	@if [ -z "$(CMD)" ]; then \
		echo 'Usage: make wp CMD="theme list"'; \
		exit 1; \
	fi
	docker compose run --rm wp-cli $(CMD)
