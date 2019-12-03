<?php

if (!function_exists('stringToInt')) {
    /**
     * Convert string to Int
     *
     * @param  string  $str
     * @return int
     */
    function stringToInt($str)
    {
        $str = str_replace(',', '', $str);

        return intval($str);
    }
}
