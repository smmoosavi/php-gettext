# php-gettext

Wrapper for php-gettext by danilo segan. This library provides PHP functions to read MO files even when gettext is not compiled in or when appropriate locale is not present on the system.

## How to Install

#### Using [Composer](http://getcomposer.org/)

Create a composer.json file in your project root:

```json
{
    "require": {
        "smmoosavi/php-gettext": "dev-master"
    }
}
```

Then run the following composer command:

```bash
$ php composer.phar install
```


## How to use

### Create translate files

```
.
├── composer.json
├── composer.lock
├── locale
│   ├── en_US
│   │   └── LC_MESSAGES
│   │       ├── messages.mo
│   │       └── messages.po
│   └── fa_IR
│       └── LC_MESSAGES
│           ├── messages.mo
│           └── messages.po
├── test.php
└── vendor
    ├── autoload.php
    ...
```


### php code


```php
<?php // test.php
require 'vendor/autoload.php';

use smmoosavi\util\gettext\L10n;

$locale = 'fa_IR';
$lang = 'fa';
L10n::init($lang, __DIR__ . "/locale/$locale/LC_MESSAGES/messages.mo");

var_dump(__('Hi'));
var_dump(__('other'));
```
### Example .po file

```
msgid ""
msgstr ""
"Project-Id-Version: php-gettext 0.0.1\n"
"Report-Msgid-Bugs-To: example@example.com\n"
"POT-Creation-Date: 2010-05-28 06:18-0500\n"
"PO-Revision-Date: 2013-08-07 11:34+0330\n"
"Last-Translator: example translator <example@example.com>\n"
"Language-Team: LANGUAGE <LL@li.org>\n"
"MIME-Version: 1.0\n"
"Content-Type: text/plain; charset=UTF-8\n"
"Content-Transfer-Encoding: 8bit\n"
"X-Generator: Poedit 1.5.5\n"

msgid "test"
msgstr "تست"

msgid "Hi"
msgstr "سلام"
```


### Converting .po to .mo

```bash
$ msgfmt -cv -o locale/fa_IR/LC_MESSAGES/messages.mo locale/fa_IR/LC_MESSAGES/messages.po
```

## TODO

* Provide `ext-gettext`. You can track progress in `topic/provide-ext-gettext` branch.

## Note

Thank Danilo Segan. [php-gettext 1.0.11](https://launchpad.net/php-gettext/trunk/1.0.11) used in this project
