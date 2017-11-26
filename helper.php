<?php

if (!function_exists('base_path')) {

    /**
     * @param $path
     */
    function base_path($path = null)
    {
        return is_null($path) ? __DIR__ : __DIR__ . '/' . $path;
    }
}
