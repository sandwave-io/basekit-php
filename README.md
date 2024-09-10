[![](https://user-images.githubusercontent.com/60096509/91668964-54ecd500-eb11-11ea-9c35-e8f0b20b277a.png)](https://sandwave.io)

# BaseKit RESTful API - PHP SDK

[![Codecov](https://codecov.io/gh/sandwave-io/basekit-php/branch/main/graph/badge.svg?token=yRUvGBQQap)](https://codecov.io/gh/sandwave-io/basekit-php)
[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/sandwave-io/basekit-php/ci.yml?branch=main)](https://packagist.org/packages/sandwave-io/basekit-php)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/sandwave-io/basekit-php)](https://packagist.org/packages/sandwave-io/basekit-php)
[![Packagist PHP Version Support](https://img.shields.io/packagist/v/sandwave-io/basekit-php)](https://packagist.org/packages/sandwave-io/basekit-php)
[![Packagist Downloads](https://img.shields.io/packagist/dt/sandwave-io/basekit-php)](https://packagist.org/packages/sandwave-io/basekit-php)

## Supported APIs

This SDK currently supports these APIs:

* [Package API](https://apidocs.basekit.com/api-reference/brands/#get-packages)
* [Sites API](https://apidocs.basekit.com/api-reference/sites/)
* [Ssl API](https://apidocs.basekit.com/api-reference/ssl/)
* [Users API](https://apidocs.basekit.com/api-reference/users/)

Are you missing functionality? Feel free to create an issue, or hit us up with a pull request.

## How to use (REST API)

```php
use SandwaveIo\BaseKit\BaseKit;

$basekit = new BaseKit('<user>', '<password>', '<api-url>');

$accountHolderRef = 123;
$brandRef = 456;

$basekit->sitesApi->create($accountHolderRef, $brandRef, "example.com");
```

## How to contribute

Feel free to create a PR if you have any ideas for improvements. Or create an issue.

* When adding code, make sure to add tests for it (phpunit).
* Make sure the code adheres to our coding standards (use php-cs-fixer to check/fix).
* Also make sure PHPStan does not find any bugs.

```bash
vendor/bin/php-cs-fixer fix

vendor/bin/phpstan analyze

vendor/bin/phpunit --coverage-text
```


These tools will also run in GitHub actions on PR's and pushes on master.
