# Serato Service Discovery

A PHP library for aiding in the discovery of Serato web applications and services.

## Installation

To include this library in a PHP project add the following line to the project's `composer.json` file
in the `require` section:

```json
{
  "require": {
    "serato/sws-discovery": "^1.0.0"
  }
}
```
See [Packagist](https://packagist.org/packages/serato/sws-discovery) for a list of all available versions.

## Host Names

`Serato\ServiceDiscovery\HostName` provides a means of discovery per-environment host names for all Serato websites and applications.

### Basic usage

```php
use Serato\ServiceDiscovery\HostName;

# Create an instance providing and environment name and number
$hostNames = new HostName('production', 1);

# Use the `HostName::get` method to return the host name for a named application
echo $hostNames->get(HostName::IDENTITY);

# Use the `HostName::getAll` method to return an array of all hosts
print_r($hostNames->getAll());
```

### `HostName::getSwsHosts` method

The `Serato\ServiceDiscovery\HostName::getSwsHosts` method provides a convenient way to fetch an array of host names for all
SWS web services.

The keys of the array are as follows:

- 'profile'
- 'da'
- 'notifications'
- 'id'
- 'license'
- 'ecom'
- 'rewards'
## Using Docker to develop this library.

Use the provided [docker-compose.yml](./docker-compose.yml) file to develop this library.

```bash
# Run the `php-build` service using the default PHP version (7.1) and remove the container after use.
docker-compose run --rm  php-build

# Provide an alternative PHP version via the PHP_VERSION environment variable.
PHP_VERSION=7.2 docker-compose run --rm  php-build
```

When Docker Compose runs the container it executes [docker.sh](./docker.sh).

This script installs some required packages, installs [Composer](https://getcomposer.org/) and performs a `composer install` for this PHP library.

It then opens a bash shell for interacting with the running container.

### AWS credentials for integration tests

To run integration tests that interact with AWS services provide an IAM access key and secret via the `AWS_ACCESS_KEY_ID` and `AWS_SECRET_ACCESS_KEY` environment variables.

```bash
AWS_ACCESS_KEY_ID=my_key_id AWS_SECRET_ACCESS_KEY=my_key_secret docker-compose run --rm  php-build
```