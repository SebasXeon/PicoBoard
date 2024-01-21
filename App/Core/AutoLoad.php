<?php

spl_autoload_register(function ($class) {
    // Convert class namespace to file path
    $file =  str_replace('\\', '/', $class) . '.php';

    // Load the class file
    if (file_exists($file)) {
        require_once $file;
    }
    else {
        throw new \Exception("Unable to load $class.");
    }
});
