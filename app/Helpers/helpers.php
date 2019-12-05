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

if (!function_exists('arrIntersect')) {
    /**
     * Convert string to array
     *  and computes the intersection of arrays
     *
     * @param  array  $arr
     * @param  string  $str
     * @return array
     */
    function arrIntersect($arr, $str)
    {
        $arrStr = explode(',', $str);
        return array_intersect($arr, $arrStr);
    }
}

if (!function_exists('isWordExist')) {
    /**
     * Check word if existing in a comma separated string
     *
     * @param  string  $str
     * @param  string  $word
     * @return boolean
     */
    function isWordExist($str, $word)
    {
        $isExist = false;
        $arr = explode(',', $str);

        if (in_array($word, $arr)) {
            $isExist = true;
        }

        return $isExist;
    }
}

if (!function_exists('getLastWord')) {
    /**
     * Get last word of the string
     *
     * @param  string  $delimeter
     * @param  string  $str
     * @return string
     */
    function getLastWord($delimiter, $str)
    {
        $arr = explode($delimiter, $str);
        return end($arr);
    }
}

if (!function_exists('getGeographicParents')) {
    /**
     * Get geographic parents
     *
     * @param  obj  $item
     * @return arr
     */
    function getGeographicParents($item)
    {
        $data = [];
        $modelName = getLastWord('\\', $item->geographic_type);
        $resourceClass = 'App\\Http\\Resources\\' . $modelName;
        $geographic = new $resourceClass($item->geographic);
        $data[strtolower($modelName)] = $geographic;
        
        while ($geographic) {
            $modelName = getLastWord('\\', $geographic->geographic_type);
            $resourceClass = 'App\\Http\\Resources\\' . getLastWord('\\', $modelName);

            if (class_exists($resourceClass)) {
                $geographic = new $resourceClass($geographic->geographic);
    
                if ($geographic) {
                    $data[strtolower($modelName)] = $geographic;
                }
            } else {
                $geographic = false;
            }
        }

        return $data;
    }
}