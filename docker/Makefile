export PROJECT_NAME = lambda-php-skeleton

DOCKER_COMPOSE = docker-compose
RUN = $(DOCKER_COMPOSE) run --rm ${PROJECT_NAME}

# DOCKER
start:
	$(DOCKER_COMPOSE) up -d
.PHONY: start

ps:
	$(DOCKER_COMPOSE) ps
.PHONY: ps

# DEVELOPMENT
cli:
	$(RUN) /bin/bash
.PHONY: cli

composer-update:
	$(RUN) composer update
.PHONY: composer-update

composer-install:
	$(RUN) composer install
.PHONY: composer-install

phpstan:
	$(RUN) sh -c "./vendor/bin/phpstan analyze -c dev/phpstan.neon"
.PHONY: phpstan

php-cs-fixer:
	$(RUN) sh -c "./vendor/bin/php-cs-fixer fix --config=dev/php-cs-fixer.php_cs"
.PHONY: php-cs-fixer

# DEPLOYMENT
serverless-deploy: composer-install-prod
	$(RUN) serverless deploy --stage dev
.PHONY: serverless-deploy

composer-install-prod:
	$(RUN) composer install --prefer-dist --optimize-autoloader --no-dev
.PHONY: composer-install-prod

# LOCAL EXECUTION
function-test:
	$(RUN) serverless invoke local --stage dev -f function
.PHONY: function-test

# CLOUD EXECUTION
function-invoke:
	$(RUN) serverless invoke --stage dev --function function --data "hello world"
.PHONY: function-invoke