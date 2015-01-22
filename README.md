# urlchecker

[![Latest Version](https://img.shields.io/github/release/viirre/urlchecker.svg?style=flat-square)](https://github.com/viirre/urlchecker/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/viirre/urlchecker/master.svg?style=flat-square)](https://travis-ci.org/viirre/urlchecker)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/viirre/urlchecker.svg?style=flat-square)](https://scrutinizer-ci.com/g/viirre/urlchecker/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/viirre/urlchecker.svg?style=flat-square)](https://scrutinizer-ci.com/g/viirre/urlchecker)
[![Total Downloads](https://img.shields.io/packagist/dt/viirre/urlchecker.svg?style=flat-square)](https://packagist.org/packages/viirre/urlchecker)

This package let's you check the status of a URL to easily check if it's "online" or not. Uses PSR1/2.

## Install

Via Composer

``` bash
$ composer require viirre/urlchecker
```

## Usage

``` php
$url = 'http://www.google.com';
$checker = new \Viirre\UrlChecker\Checker();
$status = $checker->check($url);

if ($status->isRespondingOk()) {
    echo "Url {$url} is responding ok, woho!";
}
else {
    echo "Url {$url} is NOT responding ok, reason: " . $status->getReason();
}
```

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/viirre/urlchecker/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Victor Schelin](https://github.com/viirre)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
