# Laravel Stream

[![Dependency Status](https://gemnasium.com/techinasia/laravel-stream.svg)](https://gemnasium.com/techinasia/laravel-stream)
[![Build Status](https://travis-ci.org/techinasia/laravel-stream.svg)](https://travis-ci.org/techinasia/laravel-stream)
[![Coverage Status](https://coveralls.io/repos/github/techinasia/laravel-stream/badge.svg)](https://coveralls.io/github/techinasia/laravel-stream)
[![StyleCI Status](https://styleci.io/repos/31862595/shield)](https://styleci.io/repos/31862595)

> [Stream.io](https://getstream.io) bridge for [Laravel 5](http://laravel.com/).

## Contents
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Features
- Wrapper for [Stream's](https://getstream.io) low-level PHP client.
- Multiple applications support.
- Laravel facade for client.

## Installation
Install this package with Composer:
``` bash
composer require techinasia/laravel-stream
```

Register the service provider in your `config/app.php`:
``` php
Techinasia\GetStream\StreamServiceProvider::class
```

[Optional] Register the facade in your `config/app.php`, under `aliases`:
``` php
'Stream' => Techinasia\GetStream\Facades\Stream::class
```

## Configuration
Publish all the vendor assets:
``` bash
php artisan vendor:publish
```

This will create a file called `stream.php` in the `config` folder. Create an application via [Stream's](https://getstream.io) admin interface and copy the API key and secret to the configuration file.

You can add more applications by adding more key/secret pairs to the configuration file:

``` php
'applications' => [
    'main' => [
        'key' => 'key1',
        'secret' => 'secret1',
    ],
    'foo' => [
        'key' => 'foo',
        'secret' => 'bar',
    ],
],
```

## Examples
``` php
use Techinasia\GetStream\Facades\Stream;

// Add an activity to a user feed via the default application.
$feed = Stream::feed('user', 1);
$feed->addActivity([
    'actor' => 1,
    'verb' => 'like',
    'object' => 3,
    'foreign_id' => 'post:42',
]);

// Add another activity to a user feed via another application.
$feed = Stream::application('another')->feed('user', 1);
$feed->addActivity([
    'actor' => 1,
    'verb' => 'like',
    'object' => 3,
    'foreign_id' => 'post:42',
]);
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information for what has changed recently.

## Testing
``` bash
composer test
```

## Security
If you discover any security related issues, please email dev@techinasia.com instead of using the issues tracker.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
