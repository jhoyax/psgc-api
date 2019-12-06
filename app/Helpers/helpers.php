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
     * @param  object  $item
     * @return array
     */
    function getGeographicParents($item)
    {
        $data = [];
        $geographic = [];
        getGeographicParent($item, $data, $geographic);
        
        while ($geographic) {
            getGeographicParent($geographic, $data, $geographic);
        }

        return $data;
    }
}

if (!function_exists('getGeographicParent')) {
    /**
     * Get geographic parent
     *
     * @param  object  $item
     * @param  array  &$data
     * @param  array  &$geographic
     * @return array
     */
    function getGeographicParent($item, &$data, &$geographic)
    {
        $classWithForeignKey = [
            'Province' => 'Region', 
            'District' => 'Region', 
            'SubMunicipality' => 'City',
        ];
        $modelName = getLastWord('\\', get_class($item));

        if (array_key_exists($modelName, $classWithForeignKey)) {
            $parentClass = strtolower($classWithForeignKey[$modelName]);
            $resourceClass = 'App\\Http\\Resources\\' . $classWithForeignKey[$modelName];
            $geographic = new $resourceClass($item->$parentClass);
            $data[$parentClass] = $geographic;
        } else {
            $geographicModelName = getLastWord('\\', $item->geographic_type);
            $resourceClass = 'App\\Http\\Resources\\' . $geographicModelName;

            if (class_exists($resourceClass)) {
                $geographic = new $resourceClass($item->geographic);
    
                if ($geographic) {
                    $data[strtolower($geographicModelName)] = $geographic;
                }
            } else {
                $geographic = [];
            }
        }
    }
}