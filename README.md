# urlchecker

[![Latest Version](https://img.shields.io/github/release/viirre/urlchecker.svg?style=flat-square)](https://github.com/viirre/urlchecker/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/viirre/urlchecker/master.svg?style=flat-square)](https://travis-ci.org/viirre/urlchecker)
<!--[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/viirre/urlchecker.svg?style=flat-square)](https://scrutinizer-ci.com/g/viirre/urlchecker/code-structure)
[![Total Downloads](https://img.shields.io/packagist/dt/viirre/urlchecker.svg?style=flat-square)](https://packagist.org/packages/viirre/urlchecker)-->
[![Quality Score](https://img.shields.io/scrutinizer/g/viirre/urlchecker.svg?style=flat-square)](https://scrutinizer-ci.com/g/viirre/urlchecker)

This package let's you check the status of a URL to easily check if it's "online" or not. Uses PSR 1/2. It uses Guzzle for communicating with the URLs.

## Install

Via Composer

```bash
$ composer require viirre/urlchecker
```

## Usage

```php
require_once 'vendor/autoload.php';

$url = 'http://www.google.com';
$checker = new \Viirre\UrlChecker\Checker();
$status = $checker->check($url);

if ($status->isRespondingOk()) {
    echo "Url {$url} is responding ok, woho!";
} elseif ($status->isRespondingButNotOk()) {
    echo "Url {$url} is responding, but with status code: " . $status->getStatusCode() . " and reason for not a 200: " . $status->getReason();
} elseif ($status->isNotResponding()) {
    echo "Url {$url} is NOT responding ok, fail reason: " . $status->getReason();
}
```

There are plenty of stuff to check about the connection, to get how long the connection took, use:

```php
$timeInSeconds = $status->getTimeInSeconds();
$timeInMilliSeconds = $status->getTimeInMilliSeconds();
```

And if you want to drill down further, you can access the underlying GuzzleHttp\Message\Response object to access all it's info, eg:
```php
$response = $status->getResponse();

// Get protocol info from the response
$protocol = $response->getProtocolVersion();
```

Checkout the Guzzle Response class with all the available functions at [Guzzles API](http://api.guzzlephp.org/class-Guzzle.Http.Message.Response.html)
## Testing

```bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/viirre/urlchecker/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Victor Schelin](https://github.com/viirre)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
