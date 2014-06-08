<?php
require_once '../vendor/autoload.php'; // Autoload files u
use smmoosavi\util\gettext\L10n;

$locale = 'fa_IR';
$lang = 'fa';
L10n::init($lang, __DIR__ . "/locale/$locale/LC_MESSAGES/messages.mo");

var_dump(__('Hi'));
var_dump(__('other'));

$locale = 'en_US';
$lang = 'en';
L10n::init($lang, __DIR__ . "/locale/$locale/LC_MESSAGES/messages.mo");

var_dump(__('Hi'));
var_dump(__('other'));

