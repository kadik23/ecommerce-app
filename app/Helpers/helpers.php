<?php
if (!function_exists("t")) {
    function t($key, $replace = [], $locale = null) {
        return __($key, $replace, $locale);
    }
}
