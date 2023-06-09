<?php

if (!function_exists('regex')) {
    function regex(string $pattern, string $content)
    {
        $reg = "/^( $pattern )$/u";
        return preg_match($reg, $content);
    }
}
