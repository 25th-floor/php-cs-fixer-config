25th-floor php-cs-fixer-config
==============================

Provides multiple rule sets for [`friendsofphp/php-cs-fixer`](https://github.com/FriendsOfPHP/PHP-CS-Fixer).
This repository is based on [`localheinz/php-cs-fixer-config`](https://github.com/localheinz/php-cs-fixer-config).

Requirements
------------

PHP needs to be a minimum version of PHP 7.1.0.

Installation
------------

Run

```ssh
$ composer require --dev twentyfifth/php-cs-fixer-config
```

Usage
-----

Create a configuration file `.php_cs.dist` in the root of your project:

```php
<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
;

return TwentyFifth\PhpCsFixer\Php71Config::create()
    ->setFinder($finder)
;
```
