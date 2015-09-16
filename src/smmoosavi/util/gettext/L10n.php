<?php
/**
 * User: musavi.m
 * Date: 8/7/13
 * Time: 11:00 AM
 */

namespace smmoosavi\util\gettext {

    /**
     * Class L10n
     * @package smmoosavi\util\gettext
     *
     * @static static_gettext
     * @static static_ngettext
     *
     */
    class L10n
    {
        static $lang = '';
        static $locales = array();

        public function __construct($locale_file)
        {
            $this->locale_file = $locale_file;
            $locale_file_reader = new \FileReader($locale_file);
            $this->locale_reader = new \gettext_reader($locale_file_reader);
        }

        public static function init($lang, $locale_file)
        {
            self::$lang = $lang;
            self::$locales[$lang] = new L10n($locale_file);
        }

        public static function __callStatic($name, $arguments)
        {
            if ($name === 'gettext') {
                return self::static_gettext($arguments[0]);
            }
            if ($name === 'ngettext') {
                return self::static_ngettext($arguments[0], $arguments[1], $arguments[2]);
            }

            $class = get_called_class();
            $method = $name;
            $trace = debug_backtrace();
            $file = $trace[0]['file'];
            $line = $trace[0]['line'];
            trigger_error("Call to undefined method $class::$method() in $file on line $line", E_USER_ERROR);
            return null;
        }

        public function __call($name, $arguments)
        {
            if ($name === 'gettext') {
                return $this->gettext($arguments[0]);
            }
            if ($name === 'ngettext') {
                return $this->ngettext($arguments[0], $arguments[1], $arguments[2]);
            }

            $class = get_called_class();
            $method = $name;
            $trace = debug_backtrace();
            $file = $trace[0]['file'];
            $line = $trace[0]['line'];
            trigger_error("Call to undefined method $class::$method() in $file on line $line", E_USER_ERROR);
            return null;
        }

        private function gettext($text)
        {
            return $this->locale_reader->translate($text);
        }

        private function ngettext($single, $pluar, $number)
        {
            return $this->locale_reader->ngettext($single, $pluar, $number);
        }

        private static function static_gettext($text)
        {
            if (!isset(self::$locales[self::$lang])) {
                return $text;
            }
            return self::$locales[self::$lang]->gettext($text);
        }

        private static function static_ngettext($single, $pluar, $number)
        {
            if (!isset(self::$locales[self::$lang])) {
                return $single;
            }
            return self::$locales[self::$lang]->ngettext($single, $pluar, $number);
        }

        /**
         * provide ext-gettext functions.
         */
        public static function provide_ext()
        {
            if (extension_loaded('gettext')) {
                return false; // gettext loaded by php. so nope
            }
            require_once '../../../load_ext.php';
            return true;
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