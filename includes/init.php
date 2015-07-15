<?php
/**
* Created by PhpStorm.
* User: kmmii
* Date: 08.07.2015
* Time: 12:16
*/

use Lapdoodle\app_controller;

/* autoload model classes */
function __autoload($class_name) {
    $filename = str_replace('_', DIRECTORY_SEPARATOR, $class_name);
    $filename = str_replace('Lapdoodle\\', "", $filename).'.php';
    $file = CLASSES ."/". $filename;

    if (file_exists($file) == false)
    {
        return false;
    }
    include_once($file);
    return true;
}

/* include the registry class */
include CLASSES . '/app/' . 'Registry.php';

/* include the controller class */
new app_controller();



?>