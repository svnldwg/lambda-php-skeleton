# Lambda PHP Skeleton

Skeleton to kick off projects using AWS Lambda functions with PHP. Because AWS Lambda does not natively support PHP, the Bref Framework is used which provides a layer to execute PHP code on AWS Lambda.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

#### AWS credentials

* Create AWS keys: https://bref.sh/docs/installation/aws-keys.html
* Store AWS key and secret in env vars. You may include them in your `.bash_profile` / `.zshrc`:
```
export AWS_ACCESS_KEY_ID=YOUR_AWS_KEY
export AWS_SECRET_ACCESS_KEY=YOUR_AWS_SECRET
export AWS_DEFAULT_REGION=eu-central-1
```

#### Local serverless installation
Most commands run in docker images. The bref console commands can not be executed in docker though, but must be executed locally. To use these commands, PHP >=7.2 and serverless must be installed.

See installation instructions for serverless: https://bref.sh/docs/installation.html#serverless

## Running the tests

TODO: Explain how to run the automated tests for this system

## Deployment

Deployment to AWS can be done by executing

```
make serverless-deploy
```
