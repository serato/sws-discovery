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
