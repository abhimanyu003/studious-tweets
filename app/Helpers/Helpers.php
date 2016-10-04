<?php

if (!function_exists('view')) {

    /**
     * Include template file from `/views/` directory,
     * method accepts file name and includes that
     *
     * @param $file
     */
    function view($file)
    {
        include __DIR__ . '/../Views/' . $file;
    }
}


if (!function_exists('json')) {

    /**
     * Sent proper JSON header.
     *
     * @param $content JSON
     * @return mixed
     */
    function json($content)
    {
        header('Content-Type: application/json');

        return $content;
    }
}
