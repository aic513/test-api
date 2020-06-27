SUDO := $(shell groups | grep -q docker || echo sudo)

run:
	$(SUDO) docker-compose build \
	&& $(SUDO) composer install --no-interaction \
	&& $(SUDO) composer update \
	&& $(SUDO) composer dump-autoload --optimize \
	&& $(SUDO) composer run-script phpunit tests \
	&& $(SUDO) docker-compose up -d

test:
	composer run-script phpunit tests


