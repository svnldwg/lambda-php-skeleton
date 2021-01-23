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

# DEBUG
serverless-print: ## print generated serverless.yml with all populated values
	$(RUN) serverless print --stage dev
.PHONY: serverless-print

bref-layers:
	$(RUN) vendor/bin/bref layers eu-central-1
.PHONY: bref-layers

# INVOKE FUNCTIONS LOCALLY
function-invoke-local:
	serverless invoke local --stage dev --function function --data "hello world"
.PHONY: function-invoke-local

# INVOKE FUNCTIONS ON AWS
function-invoke-cloud:
	$(RUN) serverless invoke --stage dev --function function --data "hello world"
.PHONY: function-invoke-cloud

# MONITORING
bref-dashboard:
	vendor/bin/bref dashboard
.PHONY: bref-dashboard

function-logs:
	$(RUN) serverless logs --stage dev --function function
.PHONY: http-logs

http-logs:
	$(RUN) serverless logs --stage dev --function http --tail
.PHONY: http-logs