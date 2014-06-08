<?php
/**
 * User: musavi.m
 * Date: 8/7/13
 * Time: 11:00 AM
 */

namespace smmoosavi\util\gettext {
    class L10n
    {
        static $lang;
        static $locale_file;
        static $locale_file_reader;
        /**
         * @var $locale_reader \gettext_reader
         */
        static $locale_reader;

        public static function init($lang, $locale_file)
        {
            self::$lang = $lang;
            self::$locale_file = $locale_file;
            self::$locale_file_reader = new \FileReader($locale_file);
            self::$locale_reader = new \gettext_reader(self::$locale_file_reader);
        }

        public static function gettext($text)
        {
            if (is_null(self::$locale_reader)) {
                return $text;
            }
            return self::$locale_reader->translate($text);
        }

        public static function ngettext($single, $pluar, $number)
        {
            if (is_null(self::$locale_reader)) {
                return $single;
            }
            return self::$locale_reader->ngettext($single, $pluar, $number);
        }
    }
}
namespace {
    use smmoosavi\util\gettext\L10n;

    function __($text)
    {
        return L10n::gettext($text);
    }

    function _gettext($text)
    {
        return L10n::gettext($text);
    }
}