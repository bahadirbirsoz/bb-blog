<?php


spl_autoload_register(function ($className) {
    if (substr($className, 0, 4) === "Ayep") {
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . ".php";

        if (file_exists($path)) {
            include_once $path;
        }
    }
});

