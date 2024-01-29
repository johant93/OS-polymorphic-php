<?php
/** autoload the classes */
spl_autoload_register(function ($className) {
    $classFile = __DIR__ . '/../classes/' . $className . '.php';
    $controllersFile = __DIR__ . '/../controllers/' . $className . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    } else if(file_exists($controllersFile)) {
        require_once $controllersFile;
    } else {
        throw new Exception("Unable to load $className.");
    }
});
