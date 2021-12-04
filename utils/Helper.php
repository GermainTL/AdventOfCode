<?php

namespace Utils;

class Helper
{
    public static function strContains(string $needle, string $haystack): bool // available in php 8, not in my php version (7.4)
    {
        return strpos($haystack, $needle) !== false;
    }
}