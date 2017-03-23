<?php
use Digbang\Fonts\Facade;

if (!function_exists('icon')) {
    /**
     * @param string $name
     * @param array  $options
     *
     * @return string
     */
    function icon($name, array $options = [])
    {
        return Facade::icon($name, $options);
    }
}

if (!function_exists('fa')) {
    /**
     * @param string $name
     * @param array  $options
     *
     * @return string
     */
    function fa($name, array $options = [])
    {
        return Facade::fa()->icon($name, $options);
    }
}

if (!function_exists('mat')) {
    /**
     * @param string $name
     * @param array  $options
     *
     * @return string
     */
    function mat($name, array $options = [])
    {
        return Facade::mat()->icon($name, $options);
    }
}
