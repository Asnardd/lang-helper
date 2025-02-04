# Lang-Helper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/asnardd/lang-helper.svg?style=flat-square)](https://packagist.org/packages/asnardd/lang-helper)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/asnardd/lang-helper/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/asnardd/lang-helper/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/asnardd/lang-helper/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/asnardd/lang-helper/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/asnardd/lang-helper.svg?style=flat-square)](https://packagist.org/packages/asnardd/lang-helper)

A simple package for Laravel to help you create lang files easily with artisan

## Installation

You can install the package via composer:

```bash
composer require asnardd/lang-helper
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="lang-helper-config"
```

This is the contents of the published config file:

```php
return [
    'lang-folder' => 'lang',
];
```


## Usage

```bash
php artisan make:lang {name?} {lang?}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Asnard](https://github.com/Asnard)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
