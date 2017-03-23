<?php
use Digbang\FontAwesome\Facade;

if (!function_exists('fa')) {
    /**
     * @param string $icon
     * @param array  $options
     *
     * @return string
     */
    function fa($icon, array $options = [])
    {
        return Facade::icon($icon, 'fa', $options);
    }
}

if (!function_exists('mat')) {
    /**
     * @param string $icon
     * @param array  $options
     *
     * @return string
     */
    function mat($icon, array $options = [])
    {
        return Facade::icon($icon, 'zmdi', $options);
    }
}
