prezent/inky
============

A PHP implementation of [Zurb's Inky parser](https://foundation.zurb.com/emails/docs/inky.html).

Installation
------------

You can use Composer to install this library

```bash
composer require prezent/inky
```

Usage
-----

Simply create a new `Inky` instance and feed it an email template.

```php

use Prezent\Inky\Inky;

$inky = new Inky();
echo $inky->parse('<html>....</html>');
```
